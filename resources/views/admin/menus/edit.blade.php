@extends('layout.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'add', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('menus.update', ['id' => $menuFollowIdEdit->id]) }}" method="post">
                @csrf
                <div class="form-group">
                  <label>Nhập tên menu</label>
                  <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục Menu" value="{{ $menuFollowIdEdit->name }}">
                </div>
                <div class="form-group">
                    <label>Chọn Menu Cha</label>
                    <select class="form-control" name="parent_id">
                      <option value="0">Chọn danh mục menu cha</option>
                      {!! $optionSelect !!}
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
