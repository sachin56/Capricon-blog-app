<?php

namespace App\Http\Controllers;
use App\Models\User;
use DataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.user.index');
    }

    /**
     * Show the datatable type data.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $result = User::all();

        return DataTables($result)->make(true);

    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $result =  User::find($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $result = User::find($request->id);
                $result->name = $request->name;
                $result->password = Hash::make($request->password);

                $result->save();
                
                DB::commit();
                return response()->json(['db_success' =>'Update User']);

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
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        $result = User::destroy($id);

        return response()->json($result);
    }

}
