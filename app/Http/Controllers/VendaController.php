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
            'nome_produto' => 'required',
            'valor' => 'required|numeric',
            'forma_pagamento' => 'required',
        ]);

        $venda = new Venda();
        $venda->fill($request->only([ 
            'user_id',
            'nome_produto', 
            'valor', 
            'forma_pagamento'
        ]));

        if ($venda->forma_pagamento == 'pix') {
            $venda->data_pagamento = Carbon::now();
            $venda->num_parcelas = 1;
            $venda->valor_parcela = $venda->valor;
        }
        else {
            $venda->data_pagamento = Carbon::now();
        }

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
            'nome_produto' => 'required',
            'valor' => 'required|numeric',            
            'forma_pagamento' => 'required',
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
