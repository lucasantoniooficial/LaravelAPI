<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json(Categoria::with('user')->get(),200);
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
            'nome' => 'required'
        ]);
        Categoria::create($request->all());
        return response()->json(['status' => 'success', 'message' => 'Cadastrado com sucesso'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Categoria::with('user')->find($id)){
            return response()->json(Categoria::with('user')->find($id),200);
        }

        return response()->json(['status' => 'error', 'message' => 'Nenhum usuário encontrado'],400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        $request->validate([
            'user_id' => 'nullable',
            'nome' => 'required',
        ]);

        $categoria = Categoria::findOrFail($id);

        if($request->user_id) {
            $categoria->user_id = $request->user_id;
        }

        $categoria->nome = $request->nome;
        $categoria->save();

        return response()->json(['status' => 'success', 'message' => 'Categoria atualizada com sucesso'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['status' => 'success', 'message' => 'Categoria excluída com sucesso!'], 200);
    }
}
