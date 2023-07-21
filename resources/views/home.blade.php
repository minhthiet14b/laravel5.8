  @extends('layout.admin')
  @section('title')
  <title>Trang chu</title>
  @endsection
  @section('content')
  <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Home', 'key'=>'Home'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            trang chu
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  @endsection
