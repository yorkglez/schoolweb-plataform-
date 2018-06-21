{{ csrf_field() }}
{{-- Form body --}}
<div class="row">
  <div class="col-md-9 mx-auto">
      <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
      <input name="email" type="email" id="email" class="form-control" value="{{ old('email') }}" required>
      {{-- Error message --}}
      <div class="invalid-feedback">
        El correo o la contrasena no son validos!
      </div>
  </div>
</div>
<div class="row">
   <div class="col-md-9 mx-auto">
      <label for="password"><i class="fa fa-key" aria-hidden="true"></i> Password</label>
      <input name="password" type="password" class="form-control"  required>
  </div>
</div>
<br>
<div class="row">
    <div class="col-md-7 mx-auto">
        <button type="" class="btn-lg btn-block btnlogin form-control btn btn-primary">Login</button>
    </div>
</div>
