@extends('layouts.appAdmin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Roles Tables</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Roles</a></li>
          <li class="breadcrumb-item active">Roles Tables</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Roles</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
              <a href="{{route('role.view')}}" class="btn btn-success">New Role</a>
              </div>
            </div>
          </div>
          @if (!empty($msg))
          <div class="alert alert-{{$class}}  alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>   
            <strong>{{ $msg }}</strong>
          </div>
          @endif
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($roles as $role)  
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td><a href="{{route('role.view', [$role->id])}}" class="btn btn-success">Edit</a></td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('js')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        
    })
    </script>
@endsection
