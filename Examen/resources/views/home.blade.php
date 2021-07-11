@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                
                                
                <!-- PROFESORES -->
            @if($user->professor)
                <h2><a href="/create">Crea un examen</a><br></h2>
                <h2><a href="/rank">Ranking de alumnos </a><br></h2>
                 <!-- Ahora ira un array de los examanes, con un boton de edit al lado como tipo form hacia otra vista-->
				 <h1>Examenes del profesorado (clic para editar examen)</h1>
                 @foreach($examens as $exam)
                 <h2><a href="{{ route('editarExamen',$exam->IdExamen)}}">{{$exam->Titol}}</a></h2>
                 @endforeach 
				 
				 
            @else
				<!-- ALUMNOS -->
				<p>Soy un alumno</p>
				<h2><a href="/rank">Ranking</a><br></h2>
				
				@foreach($examens as $exam)
				
						@foreach($intentoexamens as $inte)
						@if($inte->IdExamen==$exam->IdExamen and $user->id==$inte->IdUsuario)
								   <h2><a href="{{ route('verExamen',$exam->IdExamen)}}">{{$exam->Titol}}</a> TU NOTA ES: {{$inte->Nota}}</h2>
						@endif
						@endforeach 
				@endforeach 
				
				
               @endif
            </div>
		</div>
    </div>
</div>
@endsection
