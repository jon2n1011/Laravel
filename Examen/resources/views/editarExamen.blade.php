<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
	<p>VISTA EDITAR EXAMEN</p>
	
@if($user->professor)
		<form method="POST" action="/edicionExamen" enctype="multipart/form-data">
       <div class="form-group">
            
            
			
	
			
			
			@php
			$i=1;
			@endphp
			@foreach($preguntas as $pre)
				<p>Pregunta {{$i}} :<input type="text" size="40" name="{{$p='p'.+$i}}" class="form-control" value="{{$pre->Enunciado}}"></p>
					 <!-- Con esto tenemos el id de todas las preguntas -->	
				<p>Respuesta {{$i}} :<input type="text" size="40" name="{{$r='r'.+$i}}" class="form-control" value="{{$pre->Respuesta}}"> </p>
				<input type="hidden" size="40" name="{{$pr='pr'.+$i}}" class="form-control" value="{{$pre->IdPregunta}}">
					@php
					++$i
					@endphp
			@endforeach
          <!-- Con esto tenemos el examen id -->
		<input type="hidden"  name="idexamen" value="{{$id}}">				
            </div>
			
			
			<div class="form-group">
        <button type="submit" class="btn btn-primary">Editar Examen</button>
    </div>
       {{ csrf_field() }}
</form>
@else
		
		<h1> VISTA NO PERMITIDA A USUARIOS NO PROFESORES</h1>
@endif
    </body>
</html>