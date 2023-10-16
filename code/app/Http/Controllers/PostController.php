<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $result = category::all();
        return view('admin.post.index')->with(['result' => $result]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title',
            'image' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $file_name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('storage/post/', $file_name);

                    $result = new post();
                    $result->title =  $request->title;
                    $result->image =  $file_name;
                    $result->content =  $request->content;
                    $result->category_id =  $request->category_id;
                    $result->published_at =  Carbon::now();
                    $result->user_id =  auth()->user()->id;
                    $result->slug =   Str::slug($request->title);

                    $result->save();
               
                }

                DB::commit();
                return response()->json(['db_success' => 'Added New Post']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $result = post::find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title',$request->id,
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                    $result = post::find($request->id);
                    $result->title = $request->title;
                    $result->slug = Str::slug($request->title);
                    $result->content = $request->content;
                    $result->category_id =  $request->category_id;

                    if($request->file('image')){
                        $file = $request->file('image');
                        $file_name = time() . '.' . $file->getClientOriginalExtension();
                        $file->move('storage/post/', $file_name);
                        $result->image = $file_name;
                    }

                    $result->save();
               

                DB::commit();
                return response()->json(['db_success' => 'Added New Post']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(){

    }

}
