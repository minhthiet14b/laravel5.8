@extends('layout.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Thêm Slider', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('slider.update',['id' => $slider->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Tên slider</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên danh mục Menu" value=" @if(old('name')) {{ old('name') }} @else {{$slider->name}} @endif">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Ảnh Slider</label>
                    <div class="com-sm-12">
                        <img src="{{ $slider->image_path}}" alt="{{ $slider->name }}" class="img-product" width="40px">
                    </div>
                    <input type="file" class="form-control-file" name="image_path" src="@if(old('image_path')){{ old('image_path') }}@else{{$slider->image_path}}@endif">
                </div>
                @error('image_path')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="content" class="form-control tinymce_editer_init @error('content') is-invalid @enderror" rows="3">@if(old('content')) {{ old('content') }} @else {{$slider->description}} @endif</textarea>
                </div>
                @error('content')
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
@section('js')
<script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/y3dh7rbw9uoix49eaooq8s5djwq2lx2mkpq0p5srvnduf13i/tinymce/4/tinymce.min.js"></script>
<script src="{{ asset('admins\product\add\add.js') }}"></script>
@endsection
