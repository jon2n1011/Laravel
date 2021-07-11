@extends('layouts.app')

@section('content')
<div class="container">
                <h2>Add New Examen</h2>
               

@if($user->professor)
<form method="POST" action="/subirExamen" enctype="multipart/form-data">
	
	   <div class="form-group">
        <p>Titulo examen</p>
        <input type="text" name="titol" class="form-control">
  
		<p>Pregunta 1</p>
		<input type="text" name="p1" class="form-control">
		<p>Respuesta 1</p>
		<input type="text" name="r1" class="form-control">
		<p>Pregunta 2</p>
		<input type="text" name="p2" class="form-control">
		<p>Respuesta 2</p>
		<input type="text" name="r2" class="form-control">
		 <p>Pregunta 3</p>
		<input type="text" name="p3" class="form-control">
		<p>Respuesta 3</p>
		<input type="text" name="r3" class="form-control">
		<p>Pregunta 4</p>
		<input type="text" name="p4" class="form-control">
		<p>Respuesta 4</p>
		<input type="text" name="r4" class="form-control">
		<p>Pregunta 5</p>
		<input type="text" name="p5" class="form-control">
		<p>Respuesta 5</p>
		<input type="text" name="r5" class="form-control">
		<p>Pregunta 6</p>
		<input type="text" name="p6" class="form-control">
		<p>Respuesta 6</p>
		<input type="text" name="r6" class="form-control">
		<p>Pregunta 7</p>
		<input type="text" name="p7" class="form-control">
		<p>Respuesta 7</p>
		<input type="text" name="r7" class="form-control">
		<p>Pregunta 8</p>
		<input type="text" name="p8" class="form-control">
		<p>Respuesta 8</p>
		<input type="text" name="r8" class="form-control">
		<p>Pregunta 9</p>
		<input type="text" name="p9" class="form-control">
		<p>Respuesta 9</p>
		<input type="text" name="r9" class="form-control">
		<p>Pregunta 10</p>
		<input type="text" name="p10" class="form-control">
		<p>Respuesta 10</p>
		<input type="text" name="r10" class="form-control">
		
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary">Pujar Examen</button>
    </div>
    
    
    
{{ csrf_field() }}
</form>

@else
        <div>
        <p>Acceso denegado, solo pueden entrar los profesores.</p>
        </div>
    @endif

</div>
@endsection
