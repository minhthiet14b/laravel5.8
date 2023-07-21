@extends('layout.admin')
@section('title')
<title>Product</title>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admins/product/list.js')}}"></script>

@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'category', 'key'=>'List'])

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <a href="{{ route('product.create') }}" class="btn btn-success float-right m2">Add</a>
          </div>
          <div class="col-sm-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Hình ảnh</th>
                      <th scope="col">Danh mục</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as  $product)
                    <tr>
                      <th scope="row">{{ $product->id }}</th>
                      <td>{{ $product->name }}</td>
                      <td>{{ number_format($product->price) }}</td>
                      <td><img src="{{ $product->feature_img_path}}" alt="{{ $product->name }}" class="img-product" width="40px"></td>
                      <td>{{ optional($product->category)->name }}</td>
                      <td>
                        <a href="{{ route('product.edit',['id'=> $product->id])}}" class="btn btn-default">Edit</a>
                        <a data-url="{{ route('product.delete', ['id'=>$product->id])}}" href="" class="btn btn-danger action_delete" >Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
          <div class="col-sm-12">
            {{ $products->links() }}
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection
