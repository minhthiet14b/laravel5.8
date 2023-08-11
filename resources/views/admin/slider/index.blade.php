@extends('layout.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admins/product/list.js')}}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Slider', 'key'=>'List'])

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <a href="{{ route('slider.create')}}" class="btn btn-success float-right m2">Add</a>
          </div>
          <div class="col-sm-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Slider</th>
                      <th scope="col">Hinh ảnh</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as  $slider)
                    <tr>
                      <th scope="row">{{ $slider->id }}</th>
                      <td>{{ $slider->name }}</td>
                      <td><img src="{{ $slider->image_path }}" alt="" width="50" ></td>
                      <td>
                        <a href="{{ route('slider.edit', ['id' => $slider->id]) }}" class="btn btn-default">Edit</a>
                        <a data-url="{{ route('slider.delete', ['id'=>$slider->id])}}" href="" class="btn btn-danger action_delete" >Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
          <div class="col-sm-12">
            {{-- {{ $categories->links() }} --}}
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection
