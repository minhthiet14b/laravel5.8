@extends('layout.admin')
@section('title')
<title>Vai trò</title>
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
            <a href="{{ route('roles.create')}}" class="btn btn-success float-right m2">Add</a>
          </div>
          <div class="col-sm-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên</th>
                      <th scope="col">Vai trò</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  @foreach ($roles as  $role)
                  <tr>
                    <th scope="row">{{ $role->id }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>
                      <a href="{{ route('roles.edit',['id'=> $role->id])}}" class="btn btn-default">Edit</a>
                      {{-- <a data-url="{{ route('settings.delete', ['id'=>$setting->id])}}" href="" class="btn btn-danger action_delete" >Delete</a> --}}
                    </td>
                  </tr>
                  @endforeach
                </table>
          </div>
          <div class="col-sm-12">
            {{ $roles->links() }}
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection
