<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; 
use App\Models\Jangbu;

class CrosstabController extends Controller
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
       if(!$text1)$text1=date('Y');

       
        $data['text1'] = $text1;

       
        $data['list'] = $this->getlist($text1);



      return view('crosstab.index', $data);
    }
    public function getlist($text1)
    {
    $result = Jangbu::leftJoin('products', 'jangbus.products_id', '=', 'products.id')
        ->select('products.name as product_name',
            DB::raw('sum(if(month(jangbus.writeday)=1, jangbus.numo, 0)) as s1'),
            DB::raw('sum(if(month(jangbus.writeday)=2, jangbus.numo, 0)) as s2'),
            DB::raw('sum(if(month(jangbus.writeday)=3, jangbus.numo, 0)) as s3'),
            DB::raw('sum(if(month(jangbus.writeday)=4, jangbus.numo, 0)) as s4'),
            DB::raw('sum(if(month(jangbus.writeday)=5, jangbus.numo, 0)) as s5'),
            DB::raw('sum(if(month(jangbus.writeday)=6, jangbus.numo, 0)) as s6'),
            DB::raw('sum(if(month(jangbus.writeday)=7, jangbus.numo, 0)) as s7'),
            DB::raw('sum(if(month(jangbus.writeday)=8, jangbus.numo, 0)) as s8'),
            DB::raw('sum(if(month(jangbus.writeday)=9, jangbus.numo, 0)) as s9'),
            DB::raw('sum(if(month(jangbus.writeday)=10, jangbus.numo, 0)) as s10'),
            DB::raw('sum(if(month(jangbus.writeday)=11, jangbus.numo, 0)) as s11'),
            DB::raw('sum(if(month(jangbus.writeday)=12, jangbus.numo, 0)) as s12')
        )
        ->where(DB::raw('year(jangbus.writeday)'), '=', $text1)
        ->where('jangbus.io', '=', 1)
        ->orderBy('products.name')
        ->groupBy('products.name')
        ->paginate(5)->appends($text1);

    return $result;
    }

    public function getlist_product(){
        $result = Product::orderby('name')->get();
        return $result;
    }

  
    
}


