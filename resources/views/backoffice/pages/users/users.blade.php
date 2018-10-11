@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="table-log" class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
            @php 
                $i = 0; 
            @endphp
            @foreach ($allUsers as $user)
                <tr data-toggle="collapse" data-target="#{{ $i }}" role="button">
                    <td>
                        {{ $user->firstName }}
                        <div class="collapse expand" id="{{ $i }}">
                            <div class="card card-body">
                                <a href="{{ route('admin.user.edit', ['id' => $user->id, 'userType' => $user->type ])}}"> 
                                    <i class="fa fa-edit blue-square"></i> 
                                </a> 
                                
                                <a href="{{ route('admin.user.delete', ['id' => $user->id, 'userType' => $user->type])}}" onclick="return confirm('When delting this u')"> 
                                    <i class="fa fa-close red-square"></i> 
                                </a> 
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $user->lastName }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        @php
                        switch($user->type){
                            case(1):
                                echo "<span class=\"label label-primary\">User</span>";
                                break;
                            case(2):
                                echo "<span class=\"label label-warning\">Administrator</span>";
                                break;
                            case(3):
                                echo "<span class=\"label label-danger\">Publisher</span>";
                                break;
                            default:
                                echo "<span class=\"label label-primary\">User</span>";
                                break;
                        }
                        @endphp

                    <i class="fa fa-level-down right0"></i>

                    </td>
                </tr>
            @php
                $i++;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Type</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>

{!! Toastr::message() !!}

@stop