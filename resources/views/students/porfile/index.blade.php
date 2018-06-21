{{-- student porfile --}}
@extends('templates.structure')
@section('title','Perfil')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/student-porfilestyles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/build/toastr.min.css') }}">
@endsection

@section('content')
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" >
	<div class="porfilecontainer mx-auto">
		<h3>Mis datos</h3>
		<div class="table-container">
			<table class="table table-sm table-striped table-responsive-sm">
				<tbody>
					<tr>
						<th>Codigo de control: </th>
						<td id="nip">{{$datastudent->studentnip}} </td>
					</tr>
					<tr>
						<th>Nombre:</th>
						<td id="name">
							{{$datastudent->name}}
						</td>
					</tr>
					<tr>
						<th >Apellido:</th>
						<td id="lastname">
							{{$datastudent->lastname}}
						</td>
					</tr>
					<tr>
					<tr>
						<th >Fecha de nacimiento: </th>
						<td id="bdate">
							{{$datastudent->bdate}}
						</td>
					</tr>
						<th>Email: </th>
						<td  id="email">
							{{$datastudent->email}}
						</td>
					</tr>
					<tr>
						<th id="semester">Semestre: </th>
						<td></td>
					</tr>
					<tr>
						<th>Telefono: </th>
						<td  id="phone">
							{{$datastudent->phone}}
						</td>
					</tr>
					<tr>
						<th >Direccion: </th>
						<td id="address">
							{{$datastudent->address}}
						</td>
					</tr>
					<tr>
						<th >Codigo postal: </th>
						<td id="postalcode">
							{{$datastudent->postalcode}}
						</td>
					</tr>
					<tr>
						<th>Carrera: </th>
						<td id="career">{{$datastudent->career->name}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<button type="button" id="btnsave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>
 Guardar cambios</button>
		<button type="button" id="btnedit" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
		<button type="button" id="btn-changepass" class="btn btn-warning"><i class="fa fa-key" aria-hidden="true"></i> Cambiar contrasena</button>
		<div class="passwordcontainer">
			<div class="row">
				<div class="col-md-4">
					<label>Contrasena actual</label>
					<input type="password"  id="oldpassword" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Nueva contrasena</label>
					<input type="password"  id="password" class="form-control">
					<label id="cac1" class="min-cad">La contrasena debe contener al menos 8 caracteres</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Nueva contrasena</label>
					<input type="password"  id="repeatpassword" class="form-control">
					<label id="cac2" class="min-cad">La contrasena debe contener al menos 8 caracteres</label>
				</div>
			</div>
			<p id="error-pass">Las contrasenas no coinciden</p>
			<button type="button" id="btn-upadatepass" class="btn btn-primary">Actualizar</button>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>
	<script src="{{ asset('js/toastrconfig.js') }}" ></script>
	<script src="{{ asset('js/student/porfile.js') }}" ></script>
	<script>
		active(3);
		$('#btnsave').on('click',function(){
			var name = $('#name').text();
			var lastname = $('#lastname').text();
			var phone = $('#phone').text();
			var address = $('#address').text();
			var postalcode = $('#postalcode').text();
			var email = $('#email').text();
			var bdate = $('#bdate').text();
			$.ajax({
					headers: {'X-CSRF-Token': $('input[name=_token]').val()},
					url: "{{ route('student.updateinfo') }}",
					type: 'POST',
					dataType: 'json',
					data: {name: name, lastname: lastname, phone: phone, address: address,postalcode:  postalcode, email: email,bdate: bdate},
					success: function(resp){
						toastr.success('Success!', 'Tus datos se han actualizado!')
						window.setTimeout('location.reload()', 3000);
					}
				});
		});

		$('#btn-upadatepass').on('click',function(){
			if($('.alert').length>0)
				$('.alert').remove();
			if (changepass) {
				var password = $('#password').val();
				var oldpass = $('#oldpassword').val();
				$.ajax({
					headers: {'X-CSRF-Token': $('input[name=_token]').val()},
					url: "{{ route('student.changepassword') }}",
					type: 'POST',
					dataType: 'json',
					data: {newpass: password, oldpass: oldpass},
					success: function(resp){
						if (resp.validation) {
							$('.passwordcontainer').before('<div class="alert alert-success" role="alert">La contrasena a sido cambiada correctamente!</div>');
							window.setTimeout('location.reload()', 1000);
						}else{
							$('#password').val('');
							$('#repeatpasswordpassword').val('');
							$('#oldpassword').val('');
							$('.passwordcontainer').before('<div class="alert alert-danger" role="alert">La contrasena actual es incorrecta!</div>');
						}
					}
				});
			}
		});
	</script>
@endsection
