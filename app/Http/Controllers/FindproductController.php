<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; 
use App\Models\Gubun;

class FindproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
       //if (session()->get("rank")!=1) return redirect("/");

        $text1=$request->input('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

      return view('findproduct.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function getlist($text1)
    {
    //use App\Models\Product; 
    $result = Product::leftjoin('gubuns','products.gubuns_id','=','gubuns.id')->select('products.*','gubuns.name as gubun_name')->
    where('products.name','like','%'.$text1.'%')->orderby('products.name','asc')->paginate(5)->appends(['text1' => $text1]);

    return $result;
    }
    
}


