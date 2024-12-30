<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        // $pedido->produtos; // eager loading
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required',
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);

        /* Inclusão com nova instância do model auxiliar
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->save();
        */

        /* Inclusão através do relacionamento
            // $pedido->produtos // retorna os registros do relacionamento
            // $pedido->produtos() // objeto que mapeia o relacionamento
            // Um registro
            $pedido->produtos()->attach(
                $request->get('produto_id'),
                ['quantidade' => $request->get('quantidade'),]
            );
         */
        // Múltiplos registros
        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido, Produto $produto)
    {
        print_r($pedido->getAttributes());
        echo '<hr>';
        print_r($produto->getAttributes());

        /*
        // Convencional
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
        ])->delete();
        */

        // Via relacionamento
        // $produto->pedidos()->detach($pedido->id);
        $pedido->produtos()->detach($produto->id);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido]);
    }
}
