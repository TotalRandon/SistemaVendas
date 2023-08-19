<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Sistema de Vendas</title> 
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Listagem de Vendas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Forma de Pagamento</th>
                    <th>Parcelas</th>
                    <th>Valor das Parcelas</th>
                    <th>Data de Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{ $venda->user_id ? $venda->user->nome_usuario : 'Sem cliente' }}</td>
                        <td>{{ $venda->nome_produto }}</td>
                        <td>{{ $venda->valor }}</td>
                        <td>{{ $venda->forma_pagamento }}</td>
                        <td>{{ $venda->num_parcelas }}</td>
                        <td>{{ $venda->valor_parcela }}</td>
                        <td>{{ $venda->data_pagamento }}</td>
                        <td>
                            <a href="{{ route('edit', $venda->id) }}" class="btn btn-info">Editar</a>
                            <form action="{{ route('destroy', $venda->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('create') }}" class="btn btn-primary">Criar Nova Venda</a>
    </div>
</body>
</html>
