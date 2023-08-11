<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.user.add',compact('roles'));
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $role_ids = $request->role_id;
            $user->roles()->attach($role_ids);
            // foreach($role_ids as $role_id){
            //     \DB::table('role_user')->insert([
            //         'role_id' => $role_id,
            //         'user_id' => $user->id
            //     ]);
            // }
            DB::commit();
            return redirect()->route('users.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage().'File :'.$exception->getFile().'Line :'.$exception->getLine());
        }
    }
    public function edit($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $roleUser = $user->roles;
        return view('admin.user.edit',compact('roles','user','roleUser'));
    }
    public function update($id, Request $request){
        try{
            DB::beginTransaction();
            $user = $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage().'File :'.$exception->getFile().'Line :'.$exception->getLine());
        }
    }
    public function delete($id){
        try{
            $this->user->find($id)->delete();
            return response()->json([
                'code' => '200',
                'message' => 'success'
            ],200);
        }catch(\Exception $exception){
            Log::error('Message :'.$exception->getMessage().'File :'.$exception->getFile().'Line :'.$exception->getLine());
            return response()->json([
                'code' => '500',
                'message' =>'fail'
            ],500);
        }
    }
}
