<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;

class JogosController extends Controller
{
    public function index()
    {
        /* a variavel $jogos está recebendo a MODEL JOGO que chama todos os registros da tabela jogos*/
        $jogos = Jogo::all();
        /* dd($jogos); */
        return view('jogos.index', ['jogos' => $jogos]);
    }
    public function create()
    {
        return view('jogos.create');
    }
    public function store(Request $request)
    {
        /* faz a Model salvar no banco os dados submetidos no form */
        Jogo::create($request->all());
        /* redireciona para a index após salvar no banco */
        return redirect()->route('jogos-index');
    }
    /* função que através da route edit, acessa a model Jogo e atualiza o dado informado */
    public function edit($id)
    {
        $jogos = Jogo::where('id', $id)->first();
        if (!empty($jogos)) {
            return view('jogos.edit', ['jogos' => $jogos]);
        } else {
            return redirect()->route('jogos-index');
        }
    }
    public function update(Request $request, $id)
    {
        $data = [
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'ano_criacao' => $request->ano_criacao,
            'valor' => $request->valor,
        ];
        Jogo::where('id', $id)->update($data);
        return redirect()->route('jogos-index');
    }
    public function destroy($id)
    {
        Jogo::where('id', $id)->delete();
        return redirect()->route('jogos-index');
    }
}
