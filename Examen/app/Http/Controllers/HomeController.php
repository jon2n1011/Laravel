<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\ModelBDExamens;
use App\ModelBDIntentoExamen;
use App\ModelBDPreguntas;
use App\ModelBDPreguntasExamenUsuario;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		 $userId = Auth::id();
        $user = Auth::user();
		$examens=ModelBDExamens::all();
		$intentoexamens=ModelBDIntentoExamen::all();
		 return view('home',compact('user','examens','intentoexamens'));
    
    }
	
	 ///viene de un post de un formulario con lo que tiene un request
    public function subirExamen(Request $Request)
    {
       
		//Guardar examen 
        $examen = new ModelBDExamens();
        $examen->Titol = $Request->titol;
		$examen->save();
		//A partir de aqui iran las preguntas en Preguntas
		
		 $idexamen = ModelBDExamens::all()
		 ->last(); // Aqui pillo la ultima id creada anteriormente		 
		for ($i = 1; $i <= 10; $i++) {
		$p='p'.$i;
		$r='r'.$i;
		$examenpreguntas= new ModelBDPreguntas();
		$examenpreguntas->IdExamen = $idexamen->IdExamen;
		$examenpreguntas->Enunciado = $Request->$p;
        $examenpreguntas->Respuesta = $Request->$r;
        $examenpreguntas->Puntuacion = 1;
		$examenpreguntas->save();	
		}
	
        //puedes añadirle un campo a un redirect o return
        return redirect('home')->with('success','Examen colgado.');

    }
	
	 public function create()
    {
		
		
         $user = Auth::user();
		
       return view('profeexamen',compact('user'));

    }
	
		 public function rank()
    {
			$users= User::orderBy('puntuacion','DESC')->get();
			$examens=ModelBDExamens::all();
			$intentoexamen=ModelBDIntentoExamen::all();
			
       return view('rankings',compact('users','examens','intentoexamen'));

    }
	public function do($id)
    {
		$user = Auth::user();
		$preguntas = ModelBDPreguntas::where('IdExamen', $id)->get();
		$matchThese = ['IdExamen' => $id, 'IdUsuario' => $user->id];
		$control=ModelBDIntentoExamen::where($matchThese)->first();
       return view('examen',compact('preguntas','id','control'));

    }
	 public function hacerExamen(Request $Request)
    {
		
		//Para pillar id del usuario que esta haciendo el examen
       $user = Auth::user();
		//Creamos modelo de ModelBDPreguntasExamenUsuario, tendremos que hacer bucle foreach
		for ($i = 1; $i <= 10; $i++) {	
		$p='p'.$i;
		$r='r'.$i;
        $examen = new ModelBDPreguntasExamenUsuario();
        $examen->IdExamen = $Request->idexamen;
		$examen->IdPregunta=$Request->$p;
		$examen->IdUsuario=$user->id;
		$examen->Respuesta=$Request->$r;
		//Para puntuacion hay que hacer consulta, aun no es sensible a minusculas!
		$consulta=ModelBDPreguntas::where('IdPregunta',$Request->$p)->first();
		if($consulta->Respuesta==$Request->$r){
		$examen->Puntuacion=1;	
		}
		else 
		{
			$examen->Puntuacion=0;	
		}
		
		$examen->save();
		//A partir de aqui iran las preguntas en Preguntas
		
		}
	
		// Ahora haremos intentoexamen, necesitaremos sumar la puntuacion de todas las preguntas
		// Hacemos un array con la variable id examen y el id usuario, asi tenemos todos los resultados , luego usamos sum para sumar las puntuaciones, lo cual genera nuestra nota
		$arraypreguntas = ['IdExamen' => $Request->idexamen, 'IdUsuario' => $user->id];
		$notatotal=ModelBDPreguntasExamenUsuario::where($arraypreguntas)
		->sum('Puntuacion');
	
		//Creamos modelo de examen
		$intentoexamen = new ModelBDIntentoExamen();
		$intentoexamen ->IdExamen = $Request->idexamen;
		$intentoexamen ->IdUsuario=$user->id;
		$intentoexamen ->Nota=$notatotal;
		$intentoexamen->save();
		
		// Por ultimo para que sea mas sencillo el ranking sumaremos los puntos con un update sencillito
		$puntos = User::find($user->id);
		$puntos->puntuacion =($puntos->puntuacion)+$notatotal;
		$puntos->save();
		
		
		
        //puedes añadirle un campo a un redirect o return
        return redirect('home')->with('success','Examen acabado.');
	}
	
		public function editarExamen($id)
    {
			$user = Auth::user();
		$preguntas = ModelBDPreguntas::where('IdExamen', $id)->get();
       return view('editarExamen',compact('preguntas','id','user'));

    }
	
	public function edicionExamen(Request $Request){
		//Primero cambiamos preguntas y respuestas
			for ($i = 1; $i <= 10; $i++) {	
		$p='p'.$i;
		$r='r'.$i;
		$pr='pr'.$i;
        $pregunta = ModelBDPreguntas::find($Request->$pr);
		$pregunta->Enunciado=$Request->$p;
		$pregunta->Respuesta=$Request->$r;
		$pregunta->save();
		}
		
		// Segundo, lo unico que habra que hacer son deletes en las tablas, intentoexamen y preguntasexamenusuario, y restar los puntos a los usuarios.
		//Cogemos todos los itnentos de exmaen
		$intentos = ModelBDIntentoExamen::where('IdExamen', $Request->idexamen)->get();
		
		// Ahora recorremos el bucle, haciendo las consultas pertinentes
		foreach($intentos as $punt){
			
			$usuario = User::find($punt->IdUsuario);
			$usuario->puntuacion =($usuario->puntuacion)-$punt->Nota;
			$usuario->save(); 
			
		}
		
		// Por ultimo elimanos todos los intentos y preguntas examen usuario
		$deletedRows = ModelBDIntentoExamen::where('IdExamen', $Request->idexamen)->delete();
		$deletedRows2 = ModelBDPreguntasExamenUsuario::where('IdExamen', $Request->idexamen)->delete();
		
		return redirect('home')->with('success','Examen editado.');
		
	}
			public function verExamen($id)
    {
		$user = Auth::user();
		$array = ['IdExamen' => $id, 'IdUsuario' => $user->id];
		$examen= ModelBDPreguntasExamenUsuario::where($array)->get();
		$examenpreguntas=ModelBDPreguntas::where('IdExamen', $id)->get();
       return view('verExamen',compact('examen','examenpreguntas','user'));

    }
		
	
	
}
