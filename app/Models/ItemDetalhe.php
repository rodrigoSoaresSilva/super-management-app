<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    use HasFactory;

    protected $table = 'produto_detalhes';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function item()
    {
        return $this->hasOne('App\Models\Item', 'produto_Id', 'id');
    }
}
