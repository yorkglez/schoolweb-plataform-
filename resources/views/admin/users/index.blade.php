@extends('templates.structure-admin')
@section('title','Users')
@section('css')
  	<link rel="stylesheet" type="text/css" href="{{ asset('css/tablestyles.css') }}">
    <style media="screen">
      .table-container{
        max-width: 1100px;
      }
    </style>
@endsection
@section('content')
	<div class="table-container">
    <h2>Users</h2>
    <div class="form-inline">
      {!! Form::open(['method'=>'GET','route'=>'users.index','class'=>'mr-sm-2'])!!}
          <input class="form-control mr-sm-2" type="search" placeholder="Nombre, id" name="search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-2" type="submit">Buscar</button>
      {!!Form::close()!!}
    </div>
		<table class="table table-sm table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Nombre</th>
					<th scope="col">Email</th>
					<th scope="col">Telefono</th>
					<th scope="col">Tipo</th>
					<th scope="col">Accion</th>
				</tr>
			</thead>
			<tbody>
        @foreach ($users as $user)
          <tr>
            <th>{{$user->iduser}}</th>
            <td>{{$user->name.' '.$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            @if ($user->type =='admin')
              <td><span class="badge badge-primary">{{$user->type}}</span></td>
            @else
              <td><span class="badge badge-success">{{$user->type}}</span></td>
            @endif
            <td>
              <div class="form-inline">
                <div class="form-group">
                    <a class="btn btn-warning" href="{{route('users.edit',$user->iduser)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <div class="form-group mx-sm-3">
                  {!! Form::open(['method'=>'DELETE','route'=>['users.destroy',$user->iduser]]) !!}
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
	</div>
@endsection
@section('js')
  <script>
    sideitemactive(2);
  </script>
@endsection
