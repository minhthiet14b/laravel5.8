@extends('layout.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'category', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                @csrf
                <div class="form-group">
                  <label>Tên danh mục</label>
                  <input type="text" class="form-control @error('name')@enderror" name="name" placeholder="Nhập tên danh mục" value="{{ $category->name }}">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select class="form-control" name="parent_id">
                      <option value="0" class="@error('parent_id')@enderror">Chọn danh mục cha</option>
                      {!! $htmlOption !!}
                    </select>
                  </div>
                  @error('parent_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
