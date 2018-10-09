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
                                <a href="{{ route('admin.services.edit', ['id' => $user->id ])}}"> 
                                    <i class="fa fa-edit blue-square"></i> 
                                </a> 
                                
                                <a href="{{ route('admin.services.delete', ['id' => $user->id ])}}" onclick="return confirm('When delting this u')"> 
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
                                if($user->isUser == 'true'){
                                    echo "<span class=\"label label-primary\">User</span>";
                                    break;
                                }
                                echo "<span class=\"label label-success\">Super Administrator</span>";
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


<style>
.red-square{
    background-color: #dd4b39;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    color: white;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #d73925;
}
.red-square:hover{
  background: #d73925;
}

.blue-square{
    background-color: #337ab7;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    color: white;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: #337ab7;
}
.blue-square:hover{
  background: #367fa9;
}

.expand{
  margin-top: 15px;
}
.fa-level-down{
  color: #337ab7;
}
.right0{
  position: absolute;
  right: 30px;
}

.text-center{
    font-size: 12px;
}
</style>

<script>
    jQuery(function () {
        jQuery('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        })
    
    })
</script>
      

@stop