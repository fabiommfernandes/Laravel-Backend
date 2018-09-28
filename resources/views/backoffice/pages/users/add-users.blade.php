@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>User</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new user</h3>
    </div>
    <form enctype='multipart/form-data' role="form" method="post" action="{{ action('backoffice\UsersController@store') }}">
        {{ csrf_field() }}  
        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="name" placeholder="First name" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" class="form-control" name="lastname" placeholder="Last name" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
        </div>

        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
        </div>
        <template>
                <password v-model="password"/>
              </template>
              
        <div class="box-body">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <select class="form-control select2" name="type" id="type" style="width: 100%;">
                    <option selected="selected" disabled>Choose one option</option>
                    <option value="1">Super Administrator</option>
                    <option value="2">Administrator</option>
                    <option value="3">Publisher</option>
                    <option value="4">User</option>
                </select>
            </div>
        </div>
            
              
              <script>
                import Password from 'vue-password-strength-meter'
                export default {
                  components: { Password },
                  data: () => ({
                    password: null
                  }),
                  methods: {
                    showFeedback ({suggestions, warning}) {
                      console.log('🙏', suggestions)
                      console.log('⚠', warning)
                    },
                    showScore (score) {
                      console.log('💯', score)
                    }
                  }
                }
              </script>
              
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@stop