<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            /*.flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }*/

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            td {
                text-align: center;
            }

            #tdverde {
                background-color: green;
				color: black;
            }

            #tdrojo {
                background-color: yellow;
            }

            #tdblanco {
                background-color: white;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            


                               <table>

                                    <caption>Ranking</caption>

                                    <tr>
                                    
                                        <th>Usuari</th>
                                        @foreach($examens as $exam)
                                        <th><a href="{{ route('do',$exam->IdExamen)}}">{{$exam->Titol}}</a></th>
                                        @endforeach 
                                        <th>Punts</th>
                                        <th>Ranking</th>
                                    
                                    </tr>

                                    @php
                                    $pos=0;
									$correcto=false;
									$notaalta=0;
                                    @endphp

                                    @foreach($users as $usu)

                                    @if($usu->professor==0)

                                    <tr>
                                        <td class="td">{{$usu->name}}</td>
                                            
                                        @foreach($examens as $exam)
                                               @foreach($intentoexamen as $intent)
                                                        @if($intent->IdUsuario==$usu->id and $exam->IdExamen==$intent->IdExamen and $notaalta<($intent->Nota)) 
														@php
														$notaalta=$intent->Nota;
														$correcto=true;
														@endphp
                                                        @endif
														

												@endforeach 
                                                
												@if($correcto==false)
													<td id="tdrojo"></td>
												
												@elseif($correcto==true)
													<td id="tdverde">{{$notaalta}}</td>
												@endif
												
												@php
												$correcto=false;
												$notaalta=0;
												@endphp
												
                                        @endforeach

                                            <td>{{$usu->puntuacion}}</td>
                                            <td>{{++$pos}}</td> 
                                    </tr>
                                    @endif
                                    @endforeach 
                                </table>


 

            </div>
       
    </body>
</html>