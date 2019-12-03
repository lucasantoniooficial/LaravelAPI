<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Produto::with('user', 'categoria')->get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'categoria_id' => 'required|numeric',
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required|string'
        ]);

        Produto::create($request->all());

        return response()->json(['status' => 'success', 'message' => 'Produto cadastro com sucesso!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Produto::findOrFail($id),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        if($request->user_id) {
            $produto->user_id = $request->user_id;
        }else if($request->categoria_id) {
            $produto->categoria_id = $request->categoria_id;
        }

        $produto->nome = $request->nome;
        $produto->marca = $request->marca;
        $produto->preco = $request->preco;
        $produto->save();

        return response()->json(['status' => 'success', 'message' => 'Produto atualizado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['status' => 'error', 'message' => 'Produto excluido com sucesso!'], 200);
    }
}
