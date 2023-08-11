@extends('layout.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('css')
    <link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
    <script src="{{ asset('admins\product\user\add.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Thêm Slider', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('users.update',['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Tên user</label>
                  <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục Menu" value="@if (old('name')) {{old('name')}} @else {{$user->name}} @endif">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Nhập tên danh mục Menu" value="@if (old('email')) {{old('email')}} @else {{$user->email}} @endif">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nhập tên danh mục Menu" value="{{old('password')}}">
                  </div>
                  @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label>Chọn vai trò</label>
                    <select name="role_id[]" class="form-control select2_init" multiple>
                        @foreach ($roles as $role)
                            <option {{ $roleUser->contains('id',$role->id) ? 'selected':'' }} value="{{$role->id}}"> {{$role->name}} </option>
                        @endforeach
                    </select>
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

