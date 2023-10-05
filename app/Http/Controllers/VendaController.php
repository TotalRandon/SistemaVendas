<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        $vendas = Venda::all();
        $users = User::all();

        return view('index', compact('vendas', 'users'));
    }

    public function create()
    {
        $vendas = Venda::all();
        $users = User::all();

        return view('create', compact('vendas', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nome_produto' => 'required|string|max:100',
            'valor' => 'required|numeric|max:100000',
            'forma_pagamento' => 'required',
        ], [
            'user_id.required' => 'Este campo é obrigatório!',
            'nome_produto.required' => 'Este campo é obrigatório!',
            'nome_produto.max' => 'O número máximo de caracteres é de 100 apenas.',
            'valor.required' => 'Este campo é obrigatório!',
            'valor.numeric' => 'Apenas valores numéricos.',
            'valor.max' => 'Valor máximo permitido é de R$ 100.000'
        ]);

        $venda = new Venda();

        $venda->fill($request->only([
            'user_id',
            'nome_produto',
            'valor',
            'forma_pagamento'
        ]));

        $venda->data_pagamento = Carbon::now();
        $venda->num_parcelas = 1;
        $venda->valor_parcela = $venda->valor;

        $venda->save();

        return redirect()->route('index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function show(string $id)
    {
        $venda = Venda::find($id);
        if (!$venda) {
            return redirect()->route('index')->with('error', 'Venda não encontrada.');
        }

        return view('show', compact('venda'));
    }

    public function edit(string $id)
    {
        $venda = Venda::find($id);
        if (!$venda) {
            return redirect()->route('index')->with('error', 'Venda não encontrada.');
        }

        return view('edit', compact('venda'));
    }

    public function update(Request $request, string $id)
    {
        $venda = Venda::find($id);
        if (!$venda) {
            return redirect()->route('index')->with('error', 'Venda não encontrada.');
        }

        $request->validate([
            'nome_produto' => 'required|string|max:100',
            'valor' => 'required|numeric|max:100000',
            'forma_pagamento' => 'required',
        ], [
            'nome_produto.required' => 'O campo "Nome do Produto" é obrigatório!',
            'nome_produto.max' => 'O número máximo de caracteres é de 100 apenas.',
            'valor.required' => 'O campo "Valor do Produto" é obrigatório!',
            'valor.numeric' => 'Apenas valores numéricos.', 
            'valor.max' => 'Valor máximo permitido é de R$ 100.000'
        ]);

        $venda->fill($request->only([
            'nome_produto',
            'valor',
            'forma_pagamento',
            'num_parcelas',
            'valor_parcela',
            'data_pagamento'
        ]));

        if ($venda->forma_pagamento == 'cartao' || $venda->forma_pagamento == 'boleto') {
            $request->validate([
                'num_parcelas' => 'required|integer|max:12',
            ], [
                'num_parcelas.required' => 'O Campo de parcelas é obrigatório!',
                'num_parcelas.integer' => 'O número de parcelas deve ser um valor inteiro.',
                'num_parcelas.max' => 'O número máximo de parcelas é de 12 vezes.'
            ]);

            $venda->valor_parcela = $venda->valor / $venda->num_parcelas;
        }

        $venda->save();

        return redirect()->route('index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $venda = Venda::find($id);
        if (!$venda) {
            return redirect()->route('index')->with('error', 'Venda não encontrada.');
        }

        $venda->delete();

        return redirect()->route('index')->with('success', 'Venda excluída com sucesso!');
    }
}
