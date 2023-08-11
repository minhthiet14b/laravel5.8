@extends('layout.admin')
@section('title')
<title>Setting</title>
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
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle float-right m2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('settings.create','type=text') }}">text</a>
                  <a class="dropdown-item" href="{{ route('settings.create','type=textarea') }}">textarea</a>
                </div>
              </div>
          </div>
          <div class="col-sm-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Config_key</th>
                      <th scope="col">Config_value</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  @foreach ($settings as  $setting)
                  <tr>
                    <th scope="row">{{ $setting->id }}</th>
                    <td>{{ $setting->config_key }}</td>
                    <td>{{ $setting->config_value }}</td>
                    <td>
                      <a href="{{ route('settings.edit',['id'=> $setting->id]).'?type='.$setting->type}}" class="btn btn-default">Edit</a>
                      <a data-url="{{ route('settings.delete', ['id'=>$setting->id])}}" href="" class="btn btn-danger action_delete" >Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </table>
          </div>
          <div class="col-sm-12">
            {{ $settings->links() }}
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection
