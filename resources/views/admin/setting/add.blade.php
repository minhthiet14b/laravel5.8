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
    @include('partials.content-header', ['name'=>'setting', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('settings.store').'? ='.request()->type }}" method="post">
                @csrf
                <div class="form-group">
                  <label>Config key</label>
                  <input type="text" class="form-control @error('config_key') is-invalid @enderror" name="config_key" placeholder="Nhập tên danh mục">
                </div>
                @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if (request()->type === 'text')
                    <div class="value">
                        <label>Config key</label>
                        <input type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Nhập tên danh mục">
                    </div>
                @endif
                @if (request()->type === 'textarea')
                    <div class="value">
                        <label>Config key</label>
                        <textarea name="config_value" class="form-control tinymce_editer_init" rows="3">{{ old('config_value') }}</textarea>
                    </div>
                @endif
                @error('config_value')
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
{{-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> --}}
{{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/y3dh7rbw9uoix49eaooq8s5djwq2lx2mkpq0p5srvnduf13i/tinymce/4/tinymce.min.js"></script>
<script src="{{ asset('admins\product\add\add.js') }}"></script>
@endsection
