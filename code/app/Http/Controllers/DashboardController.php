<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\category;
use App\Models\User;
use DataTables;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $postCount = post::all()->count(); 
        $categoryCount = category::all()->count(); 
        $userCount = User::all()->count();

        return view('admin.dashboard.index',compact(['postCount','categoryCount','userCount']));
    }

    /**
     * Show the datatable type data.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $result = post::all();

        return DataTables::of($result)
                        ->addColumn('category_name', function(post $post){
                            return $post->category->category_name;
                        })
                        ->addColumn('name', function(post $post){
                            return $post->user->name;
                        })
                        ->make(true);
    }

    
}
