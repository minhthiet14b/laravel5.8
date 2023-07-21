@extends('layout.admin')
@section('title')
<title>Add Product</title>
@endsection

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Product', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-10">
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Tên sản phẩm: </label>
                  <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label>Giá: </label>
                    <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <input type="file" class="form-control-file" name="feature_img_path" >
                </div>
                <div class="form-group">
                    <label>Ảnh chi tiết</label>
                    <input type="file" multiple class="form-control-file" name="img_path[]" >
                </div>
                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select class="form-control select2_init" name="category_id">
                      <option value="0">Chọn danh mục cha</option>
                      {!! $htmlOption !!}
                    </select>
                </div>
                <div class="form-group">
                <label>Tags</label>
                    <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                    </select>
                </div>
                <div class="form-group">
                    <label>Nhập nội dung</label>
                    <textarea name="content" class="form-control tinymce_editer_init" rows="3"></textarea>
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

@section('js')
<script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
{{-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> --}}
{{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/y3dh7rbw9uoix49eaooq8s5djwq2lx2mkpq0p5srvnduf13i/tinymce/4/tinymce.min.js"></script>
<script src="{{ asset('admins\product\add\add.js') }}"></script>
@endsection
