<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos()
    {
        // Nomes padronizados Laravel
        // return $this->belongsToMany('App\Models\Produto', 'pedido_produtos');

        /* Nomes não padronizados: mapeamento

            1 - Modelo do relacionamento NxN em relação ao Modelo que estamos implementando
            2 - Tabela auxiliar que armazena os registros de relacionamento
            3 - Nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
            4 - Nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
        return $this->belongsToMany('App\Models\Item', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at');
    }
}
