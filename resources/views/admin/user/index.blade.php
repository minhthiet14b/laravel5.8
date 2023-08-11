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
              <a href="{{ route('users.create')}}" class="btn btn-success float-right m2">Add</a>
          </div>
          <div class="col-sm-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên user</th>
                      <th scope="col">Email</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as  $user)
                    <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-default">Edit</a>
                        <a data-url="{{ route('users.delete', ['id'=>$user->id])}}" href="" class="btn btn-danger action_delete" >Delete</a>
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
