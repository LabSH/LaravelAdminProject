<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gubun; 

use Response;

class AjaxController extends Controller
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

      return view('ajax.index', $data);
    }

    public function save_row(Request $request, $row){

        $request->validate([
            'name' => 'required|max:20'
        ],
        [
            
            'name.required' => '이름는 필수입력입니다.',
            'name.max' => '20자 이내입니다.'
        ]);
        

     
        $row->name = $request->input("name");
        $row->save(); // 알아서 sql문으로 바꿔서 저장해줌 , 수정이든 이 코드는 똑같음.
    }


    public function store(Request $request)
    {
        $tmp = $this->qstring();
        $row = new Gubun; //gubun모델변수 row선언 Gubun는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
        return response()->json($row); //목록화면으로 이동
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
        $row = Gubun::find($id);//gubun모델변수 row선언 Gubun는 테이블
                            // new는 추가 , 수정 : find , ...
        $this->save_row($request, $row);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Gubun::find($id)->delete();
    }

    public function getlist($text1)
    {
    //use App\Models\Gubun; 
    $result = Gubun::where('name', 'like', '%' . $text1 . '%')->orderBy('name', 'asc')->paginate(5)->appends(['text1' => $text1]);
    return $result;
    // use llluminate\Support\Facades\DB;
    // $sql = 'select * from gubuns order by name';
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

// 시파 조깥네 !!!!!!!!!!!!!!!! 다안돼.
