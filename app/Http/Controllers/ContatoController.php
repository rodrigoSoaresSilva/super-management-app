<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        /*$contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');*/

        /*$contato = new SiteContato();
        $contato->fill($request->all());
        $contato-save();*/

        $request->validate(
            [
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contatos_id' => 'required',
                'mensagem' => 'required|max:2000',
            ],
            [
                'required'  => 'O campo precisa ser preenchido',
                'nome.min'  => 'O campo nome precisa ter no mínimo 3 caracteres',
                'nome.max'  => 'O campo nome deve ter no máximo 40 caracteres',
                'email.email' => 'O e-mail não é válido',
                'mensagem.max'  => 'O campo mensagem deve ter no máximo 2000 caracteres',
            ]
        );

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
