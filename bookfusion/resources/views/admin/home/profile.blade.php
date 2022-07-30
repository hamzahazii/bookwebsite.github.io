@extends('admin/layout/master')
@section('page-title')
  {{ Auth::user()->name }}
@endsection
@section('main-content')
<section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle img-profile" src="/uploads/{{ Auth::user()->user_img }}" width="128" height="128" alt="{{ Auth::user()->name }}">
              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
              <p class="text-muted text-center">{{ Auth::user()->designation }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Edit your Profile</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="{{ $errors->has('update_password') || $errors->has('current_password') || $errors->has('new_password') ? '' : 'active' }}"><a href="#activity" data-toggle="tab">Bio</a></li>
              <li class="{{ $errors->has('update_password') || $errors->has('current_password') || $errors->has('new_password') ? 'active' : '' }}"><a href="#settings" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="{{ $errors->has('update_password') || $errors->has('current_password') || $errors->has('new_password') ? '' : 'active' }} tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <p>{{ Auth::user()->bio }}</p>
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->

              <div class="{{ $errors->has('update_password') || $errors->has('current_password') || $errors->has('new_password') ? 'active' : '' }} tab-pane" id="settings">
                <div class="msg-pass"></div>
                <form method="post" action="{{ route('update.password') }}" class="form-horizontal">
                @csrf
                  <div class="form-group @error('current_password') has-error @enderror">
                    <label for="inputName" class="col-sm-2 control-label">Old Password</label>
                    <div class="col-sm-10">
                    	<input type="password" class="form-control" name="current_password" id="current_password" placeholder="Old Password">
                    	@error('current_password')
							<div class="label label-danger">{{ $message }}</div>
						@enderror	
                    </div>
                  </div>
                  <div class="form-group @error('new_password') has-error @enderror">
                    <label for="inputName" class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                    	<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                    	@error('new_password')
							<div class="label label-danger">{{ $message }}</div>
						@enderror
                    </div>
                  </div>
                  <div class="form-group @error('new_confirm_password') has-error @enderror">
                    <label for="inputName" class="col-sm-2 control-label">Retype Please</label>
                    <div class="col-sm-10">
                    	<input type="password" class="form-control" name="new_confirm_password" id="new_confirm_password" placeholder="Retype Please">
                    	@error('new_confirm_password')
							<div class="label label-danger">{{ $message }}</div>
						@enderror
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger reset-password">Change Password</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section> 
@endsection

@section('scripts')
<script>
{{-- CHANGE PASSWORD VIA AJAX START --}}
    $(document).ready(function() {
      $("body").on('click', '.reset-password', function(event) {
        event.preventDefault();
        var self = $(this);
        var data = self.closest('form');

        $.ajax({
          url: data.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data.serialize(),
        })
        .done(function(data) {
          if (data.status) 
          {
            $(".msg-pass").html('<div class="alert alert-success">'+data.msg+'</div>');
            self.closest('form')[0].reset(); //reset your form after updated your password.
          }
          
          setTimeout(function() {
            $(".msg-pass").html('')
          }, 3000);
        })

        .fail(function(data) {
          console.log(data.responseJSON);
          $(".msg-pass").html('<div class="alert alert-danger">'+data.responseJSON.message+'</div>');
          $.each(data.responseJSON.errors, function(key, val) {
            var input = $('input[name='+key+']');
            input.closest('.form-group').addClass('has-error');
            input.next().html(val);
          });
        })
        .always(function() {
          console.log("complete");
        });
      }); 
      
      {{-- PROFILE UPDATE VIA AJAX END --}}
      $("body").on('click', '.profile-update', function(event) {
        event.preventDefault();
        var self = $(this);
        var dataForm = self.closest('form');
        alert(dataForm);

          $.ajax({
            url: dataForm.attr('action'),
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: new FormData(dataForm[0]);
          })
          .done(function(data) {
              if (data.status) 
              {
                $(".msg-profile").html('<div class="alert alert-success">'+data.msg+'</div>');
                $(".img-profile").attr('src', '/uploads/' + data.myrow.user_img);

                setTimeout(function() {
                  $("#modal-default").modal('hide');
                }, 3000);
              }
            })
        .fail(function(data) {
            $(".msg-profile").html('<div class="alert alert-danger">'+data.responseJSON.message+'</div>');
            $.each(data.responseJSON.errors, function(key, val) {
              var inpu = $('[name='+ key +']').closest('.form-group');
              inpu.addClass('has-error')
              inpu.find('span').html(val)
            });
          })
          .always(function() {
              console.log("complete");
          });     
        });
    })

</script>
@endsection

