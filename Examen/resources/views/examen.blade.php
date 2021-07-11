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
	<p>Sera vista de examen</p>
	
@if($control==null)
		<form method="POST" action="/hacerExamen" enctype="multipart/form-data">
       <div class="form-group">
            
            
			
	
			
			
			@php
			$i=1;
			@endphp
			@foreach($preguntas as $pre)
				<p>{{$pre->Enunciado}}</p>
				
				<input type="text" name="{{$r='r'.+$i}}" class="form-control" value="{{$r='r'.+$i}}">
				 <!-- Con esto tenemos el id de todas las preguntas -->
				<input type="hidden" name="{{$p='p'.+$i}}" value="{{$pre->IdPregunta}}">	
					@php
					++$i
					@endphp
			@endforeach
          <!-- Con esto tenemos el examen id -->
		<input type="hidden"  name="idexamen" value="{{$id}}">				
            </div>
			
			
			<div class="form-group">
        <button type="submit" class="btn btn-primary">Corregir Examen</button>
    </div>
       {{ csrf_field() }}
</form>
@else
		<p>Id examen {{$control->IdExamen}}</p>
		<p>Id usuario {{$control->IdUsuario}}</p>
		<h1> No puedes hacer este examen debido a que ya lo has realizado</h1>
@endif
    </body>
</html>