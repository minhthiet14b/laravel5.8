<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDO;
use DB;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role,Permission $permission){
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index(){
        $roles = $this->role->paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    public function create(){
        $permissions = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add',compact('permissions'));
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage().'File :'.$exception->getFile().'Line :'.$exception->getLine());
        }
        }
    public function edit($id){
        $role = $this->role->find($id);
        $permissions = $this->permission->where('parent_id',0)->get();
        $rolePermission = $role->permissions;
        return view('admin.role.edit',compact('role','permissions','rolePermission'));
    }
    public function update($id,Request $request){
        try{
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role = $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage().'File :'.$exception->getFile().'Line :'.$exception->getLine());
        }
    }
    public function createPermission(){
        return view('admin.permission.add');
    }
}
