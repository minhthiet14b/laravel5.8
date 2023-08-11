@extends('layout.admin')
@section('title')
<title>Chỉnh sửa vai trò</title>
@endsection
@section('css')
    <link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins/role/add.css')}}">
@endsection
@section('js')
   <script src="{{asset('admins/role/add.js')}}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Chỉnh sửa vai trò', 'key'=>'Update'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('roles.update',['id'=>$role->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                        <div class="form-group">
                        <label>Tên vai trò</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục Menu" value="@if(old('name')) {{old('name')}} @else {{$role->name}} @endif">
                        </div>
                        <div class="form-group">
                            <label>Mô trả vai trò</label>
                            <textarea name="display_name" class="form-control" cols="30" rows="4">@if(old('display_name')) {{ old('display_name') }} @else {{$role->display_name}} @endif</textarea>
                        </div>

                </div>
                <div class="col-md-12">
                    <label for=""><input type="checkbox" class="checkall"> Check All</label>
                </div>
                <div class="col-md-12">
                    @foreach ($permissions as $permission)
                    <div class="card border-primary mb-3 col-md-12">
                        <div class="card-header"><label for="">
                            <input type="checkbox" value="{{$permission->id}}" class="checkbox_wrapper">
                        </label> Module {{$permission->name}}</div>
                        <div class="row">
                            @foreach ($permission->permissionsChildren  as  $permissionChildren)
                            <div class="card-body text-primary  col-md-3">
                                <label for="">
                                    <input type="checkbox" name="permission_id[]" value="{{$permissionChildren->id}}" class="checkbox_childrent" {{ $rolePermission->contains('id',$permissionChildren->id) ? 'checked':'' }}>
                                </label> {{$permissionChildren->name}} </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection

