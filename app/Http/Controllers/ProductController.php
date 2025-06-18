<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; 
use App\Models\Gubun;
use Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //if (session()->get("rank")!=1) return redirect("/");
        $data['tmp'] = $this->qstring();

        $text1=request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        

      return view('product.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['list'] = $this->getlist_gubun();
        $data['tmp'] = $this->qstring();
        return view('product.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save_row(Request $request, $row){

        $request->validate([
            'gubuns_id' => 'required|numeric',
            'name' => 'required|max:20',
            'price' => 'required|numeric'
        ],
        [
            'gubuns_id.required' => '구분명은 필수입력입니다.',
            'price.required' => '단가는 필수입력입니다.',
            'name.required' => '이름는 필수입력입니다.',
            'name.max' => '50자 이내입니다.'
        ]);
        
        $row->gubuns_id = $request->input("gubuns_id");
        $row->name = $request->input("name");
        $row->price = $request->input("price");
        $row->jaego = $request->input("jaego");
        

        if($request->hasFile('pic')){
            $pic = $request->file('pic');
            $pic_name = $pic->getClientOriginalName(); // 파일이름
            $pic->storeAs('public/product_img', $pic_name); // 파일저장


            $img = Image::make($pic)
            ->resize(null, 200, function($constraint) { $constraint->aspectRatio();})
            ->save('storage/product_img/thumb/'.$pic_name);


            $row->pic = $pic_name;
        }else if($row->pic){
         
            $pic_name = $row->pic;

    // 기존 파일로부터 썸네일 다시 생성 및 저장
            $existingFilePath = public_path('storage/product_img/' . $pic_name);
            if (file_exists($existingFilePath)) {
             $img = Image::make($existingFilePath)
            ->resize(null, 200, function($constraint) { $constraint->aspectRatio(); })
            ->save(public_path('storage/product_img/thumb/' . $pic_name));
    }
             
        }

        $row->save(); // 알아서 sql문으로 바꿔서 저장해줌 , 수정이든 이 코드는 똑같음.
    }


    public function store(Request $request)
    {
        $tmp = $this->qstring();
        $row = new Product; //product모델변수 row선언 Product는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
        return redirect('product'.$tmp); //목록화면으로 이동
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['tmp'] = $this->qstring();

        $data['row'] = Product::leftjoin('gubuns','products.gubuns_id','=','gubuns.id')->select('products.*','gubuns.name as gubun_name')->
        where('products.id','=',$id)->first();
        return view('product.show',$data); // 여기에나오는 주소는 파일주소임.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['list'] = $this->getlist_gubun();
        $data['tmp'] = $this->qstring();
        $data['row'] = Product::find($id);
        return view('product.edit',$data); // 여기에나오는 주소는 파일주소임.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, $id)
    {
        $row = Product::find($id);//product모델변수 row선언 Product는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
        $tmp = $this -> qstring();
        return redirect('product' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Product::find($id)->delete();
       $tmp = $this->qstring();
       return redirect('product' . $tmp);
    }

    public function getlist($text1)
    {
    //use App\Models\Product; 
        $result = Product::leftjoin('gubuns','products.gubuns_id','=','gubuns.id')->select('products.*','gubuns.name as gubun_name')->
        where('products.name','like', '%'.$text1.'%')->orderby('products.name', 'asc')->paginate(10)->appends(['text1' => $text1]);

        return $result;
    // use llluminate\Support\Facades\DB;
    // $sql = 'select * from products order by name';
    // result = DB::select($sql);
    // 위의 코드와 이 코드는 같은 의미임 선호하는건 지금사용즁인 코드.
    }
    
    public function getlist_gubun(){
        $result = Gubun::orderby('name')->get();
        return $result;
    }

    public function qstring()
    {
        $text1 = request("text1") ? request('text1'): "";
        $page = request('page') ? request('page'): "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }
    
    public function jaego(){
        DB::statement('drop table if exists temps;');
        DB::statement('create table temps(
        id int not null auto_increment,
        products_id int,
        jaego int default 0,
        primary key(id)); ');
        DB::statement('update products set jaego=0;');
        DB::statement('insert into temps (products_id, jaego)
        select products_id, sum(numi)-sum(numo)
        from jangbus
        group by products_id;');
        DB::statement('update products join temps
        on products.id=temps.products_id
        set products.jaego=temps.jaego;');
        return redirect('product');
    }
}


