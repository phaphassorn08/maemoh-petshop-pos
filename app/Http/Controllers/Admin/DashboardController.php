<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use PDF;
use Cookie;
use App\Exports\RevenueExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request){

        $users = User::all()->count();
        $transactions = Transaction::all()->count();
        $products = Product::all()->count();
        $income = Transaction::all()->sum('total_price');

	
        $result = DB::table("transactions")
        ->select(DB::raw("(sum(total_price)) as total_price"), 
        DB::raw("(DATE_FORMAT(created_at, '%d')) as created_at")
        )
        ->orderBy('created_at')
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d')"))
        ->get();

        $data_line = "";
        foreach ($result as $val){
            $data_line .= "['".(string)$val->created_at."',".(int)$val->total_price."],";
        }


        $rev_date=DB::table("transactions")
        ->select(DB::raw("(sum(total_price)) as total_price"), 
        DB::raw("(DATE_FORMAT(created_at, '%d')) as created_at")
        )
        ->orderBy('created_at')
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d')"))
        ->get();

        $rev_date_json = json_decode($rev_date, true);
        $labels=[];
        $data=[];
        foreach($rev_date_json as $val){
            $labels[]=$val['created_at'];
            $data[]=$val['total_price'];
        }

        $rev_year=DB::table("transactions")
        ->select(DB::raw("(sum(total_price)) as total_price"), 
        DB::raw("(DATE_FORMAT(created_at, '%b')) as created_at")
        )
        ->orderBy('created_at')
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%b')"))
        ->get();
    
        $rev_year_json = json_decode($rev_year, true);
        $plabels=[];
        $pdata=[];
        foreach($rev_year_json as $val){
            $plabels[]=$val['created_at'];
            $pdata[]=$val['total_price'];
        }
        return view('admin.dashboard', compact('users','transactions','products','income','data_line'),['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);
    }
}
