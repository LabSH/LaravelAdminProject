<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Worker; 

class WorkerController extends Controller
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

      return view('worker.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tmp'] = $this->qstring();
        return view('worker.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save_row(Request $request, $row){

        $request->validate([
            'name' => 'required|max:20',
        ],
        [
            'name.required' => '이름는 필수입력입니다.',
            'name.max' => '20자 이내입니다.'
        ]);
        

        $phone1 = $request->input("phone1");
        $phone2 = $request->input("phone2");
        $phone3 = $request->input("phone3");
        $phone = sprintf("%-3s%-4s%-4s",$phone1,$phone2,$phone3);

        $gender = $request->input("gender") == 0 ? '남자' : '여자';

        $row->name = $request->input("name");
        $row->phone = $phone;
        $row->gender = $gender;

        $row->save(); // 알아서 sql문으로 바꿔서 저장해줌 , 수정이든 이 코드는 똑같음.
    }


    public function store(Request $request)
    {
        $tmp = $this->qstring();
        $row = new Worker; //worker모델변수 row선언 Worker는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
        return redirect('worker'.$tmp); //목록화면으로 이동
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

        $data['row'] = Worker::find($id);
        return view('worker.show',$data); // 여기에나오는 주소는 파일주소임.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tmp'] = $this->qstring();
        $data['row'] = Worker::find($id);
        return view('worker.edit',$data); // 여기에나오는 주소는 파일주소임.
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
        $row = Worker::find($id);//worker모델변수 row선언 Worker는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
        $tmp = $this -> qstring();
        return redirect('worker' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Worker::find($id)->delete();
       $tmp = $this->qstring();
       return redirect('worker' . $tmp);
    }

    public function getlist($text1)
    {
    //use App\Models\Worker; 
    $result = Worker::where('name', 'like', '%' . $text1 . '%')->orderBy('name', 'asc')->paginate(5)->appends(['text1' => $text1]);
    return $result;
    // use llluminate\Support\Facades\DB;
    // $sql = 'select * from workers order by name';
    // result = DB::select($sql);
    // 위의 코드와 이 코드는 같은 의미임 선호하는건 지금사용즁인 코드.
    }
    
    public function qstring()
    {
        $text1 = request("text1") ? request('text1'): "";
        $page = request('page') ? request('page'): "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }

}


