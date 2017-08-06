<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
use App\Borrowlog;

class StatisticsController extends Controller
{
    //
    public function index(Request $request,Builder $htmlBuilder)
    {
    	if($request->ajax()){
    		$stats = Borrowlog::with('book','user');

    		return Datatables::of($stats)
    		->addColumn('returned_at',function($stats){
    			if ($stats->is_returned){
    				return $stats->updated_at;
    			}
    			return "Masih dipinjam";
    		})->make(true);
    	}
    	$html =$htmlBuilder
    	->addColumn(['data'=>'book.title','name'=>'book.title','title'=>'judul'])
    	->addColumn(['data'=>'user.name','name'=>'user.name', 'title'=>'Peminjam'])
    	->addColumn(['data'=>'created_at','name'=>'created_at', 'title'=>'Tanggal Pinjam','searchable'=>false])
    	->addColumn(['data'=>'returned_at','name'=>'returned_at', 'title'=>'Tanggal Kembali', 'orderable'=>false, 'searchable'=>false]);

    	return view('statistics.index')->with(compact('html'));


    }
}
