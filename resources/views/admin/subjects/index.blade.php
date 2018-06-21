{{-- index subjects --}}
@extends('templates.structure-admin')
@section('title','Carreras')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/paginationstyles.css') }}">
  	<style>
  		.table-container{
  			max-width: 950px;
  		}
  	</style>
@endsection
@section('content')
	<h2>Materias</h2>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}" placeholder="">
	<div class="modal fade" id="Modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="name">Codigo:</label>
						<input required class="form-control" name="code" id="code" type="text">
					</div>
					<div class="form-group col-md-12">
						<label for="name">Nombre:</label>
						<input required class="form-control" name="name" id="name" type="text">
					</div>
					<div class="form-group col-md-12">
						<label for="name">Creditos:</label>
						<input required class="form-control" name="credits" id="credits" type="number">
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnclose" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="btnsave" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
	<div class="table-container">
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Codigo</th>
					<th scope="col">Nombre</th>
					<th scope="col">Creditos</th>
					<th scope="col">Accion</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($subjects as $subject)
					<tr>
						<th class="th-code" scope="row">{{$subject->code}}</th>
						<td class="td-name">{{$subject->name}}</td>
						<td class="td-credits">{{$subject->credits}}</td>
						<td>
							<div class="form-inline">
								<div class="form-group">
										<buttom data-toggle="modal" data-target="#Modaledit"  class="btnedit btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></buttom>
								</div>
								<div class="form-group mx-sm-3">
									{!! Form::open(['method'=>'DELETE','route'=>['subjects.destroy',$subject->code]]) !!}
										<button type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro que deseas eliminarlo?')">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
										</button>
									{!! Form::close() !!}
								</div>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div id="pagination" class="mx-auto" style="width: 200px;">
		    {{$subjects->links()}}
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('js/pagination.js') }}"></script>
	<script src="{{ asset('js/admin/subjects.js') }}"></script>
	<script>
		sideitemactive(7);
		$('#btnsave').on('click', function() {
			var code =  $('#code').val();
			var name = $('#name').val();
			var credits = $('#credits').val();
			$.ajax({
				headers: {'X-CSRF-Token': $('input[name=_token]').val()},
				url: "{{ route('admin.updatesubject') }}",
				type: 'POST',
				dataType: 'json',
				data: {code: code ,name: name, credits: credits},
				success: function(resp){
					if(resp.update){
            		location.reload();
					}
				}
			});
		});
	</script>
@endsection
