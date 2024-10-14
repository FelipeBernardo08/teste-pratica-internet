<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Exception;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{

    private $noticia;

    public function __construct(Noticia $noticias)
    {
        $this->noticia = $noticias;
    }

    public function criarNoticia(Request $request): object
    {
        try {
            $response = $this->noticia->criarNoticia($request);
            if (count($response) != 0) {
                return response()->json($response, 200);
            }
            return response()->json(['error' => 'Erro ao criar noticias, tente novamente mais tarde!'], 404);
        } catch (Exception $e) {
            return response()->json($e, 404);
        }
    }

    public function lerNoticias(): object
    {
        try {
            $response = $this->noticia->lerNoticias();
            if (count($response) != 0) {
                return response()->json($response, 200);
            }
            return response()->json(['error' => 'Erro ao ler noticias, tente novamente mais tarde!'], 404);
        } catch (Exception $e) {
            return response()->json($e, 404);
        }
    }
}
