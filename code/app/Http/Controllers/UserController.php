<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\u_role;
use App\Models\u_user_role;
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
        $role = u_role::all();
        return view('admin.user.index')->with(['roles' => $role]);
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
        $result['users'] = User::find($id);

        $result['u_user_roles'] = u_user_role::select('role_id')->where(['user_id' => $id])->get();

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
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $result = User::find($request->id);
                $result->name = $request->name;

                $result->save();

                $this->delete_roles( $result->id);

                $roles =$request->role_id;
                $users = $result->id;

                foreach( $roles as $role){

                    $user_role = new u_user_role;
                    $user_role->user_id = $users;
                    $user_role->role_id = $role;

                    $user_role->save();

                }
                
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

    public function delete_roles($id){
        u_user_role::where(['user_id' => $id])->delete();
     }

}
