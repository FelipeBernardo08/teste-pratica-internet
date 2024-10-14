<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo'
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'fk_noticia');
    }

    public function criarNoticia(object $noticia): array
    {
        return self::create([
            'titulo' => $noticia->titulo,
            'conteudo' => $noticia->conteudo
        ])->toArray();
    }

    public function lerNoticias(): array
    {
        return self::with('comentarios')->get()->toArray();
    }
}
