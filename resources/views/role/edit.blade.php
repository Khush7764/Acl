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
            <h1>Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Role</a></li>
              <li class="breadcrumb-item active">Role Permissions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Role Permissions</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{route('role.createOrUpdate')}}" method="POST" >
                    <div class="form-group col-md-6">
                        @csrf
                        @if(!empty($role_id))
                          <input type="hidden" name="role_id" value="{{$role_id}}">
                          <input type="hidden" name="old_permissions" value="{{json_encode($userPer)}}">
                        @else
                          <label>Role-name</label>
                          <input type="text" name="role_name" value="" class="form-control" width="50">
                          
                        @endif                        
                       
                        <ul>
                            @foreach($permissions as $key => $value)
                            <li class="list-unstyled">
                        <input type="checkbox" name="permission_id[]" value="{{ $value->id }}" @if (!empty($role_id)) {{(in_array($value->id, $userPer)) ? 'checked' : '' }} @endif
                        > {{ $value->menu_name }}
                        @if(count($value->allPermissions) > 0)
                            @include('role.submenu',['childs' => $value->allPermissions])
                        @endif
                        </li>
                        @endforeach
                        </ul>   
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>                
                </form>
              </div>
              <!-- /.col -->
        
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
<!-- ./wrapper -->
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
