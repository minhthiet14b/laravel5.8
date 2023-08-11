@extends('layout.admin')
@section('title')
<title>Permission</title>
@endsection
@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Permission', 'key'=>'ADD'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Chọn Menu Cha</label>
                    <select class="form-control" name="module_parent">
                        <option value="">Chọn tên module</option>
                       @foreach (config('permissions.table_module') as $moduleItem)
                        <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        @foreach (config('permissions.list_module') as $moduleItemChildrent)
                        <div class="col-md-3">
                            <input type="checkbox" value="{{$moduleItemChildrent}}" name="module_childrent[]">
                            <label>{{$moduleItemChildrent}}</label>

                        </div>
                        @endforeach
                    </div>
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
