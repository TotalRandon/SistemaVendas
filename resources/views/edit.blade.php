<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cadastro</title> 
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Venda</h1>

        <form action="{{ route('update', $venda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto:</label>
                <input type="text" name="nome_produto" id="nome_produto" class="form-control" value="{{ $venda->nome_produto }}">
                @error('nome_produto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor do Produto:</label>
                <input type="text" name="valor" id="valor" class="form-control" value="{{ $venda->valor }}">
                @error('valor')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento:</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-select">
                    <option value="cartao" {{ $venda->forma_pagamento == 'cartao' ? 'selected' : '' }}>Cartão</option>
                    <option value="boleto" {{ $venda->forma_pagamento == 'boleto' ? 'selected' : '' }}>Boleto</option>
                    <option value="pix" {{ $venda->forma_pagamento == 'pix' ? 'selected' : '' }}>Pix</option>
                </select>
            </div> 

            @if($venda->forma_pagamento == 'cartao' || $venda->forma_pagamento == 'boleto')
                <div class="mb-3">
                    <label for="num_parcelas" class="form-label">Número de Parcelas:</label>
                    <input type="number" name="num_parcelas" id="num_parcelas" class="form-control" value="{{ $venda->num_parcelas }}">
                    @error('num_parcelas')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="mb-3">
                <label for="data_pagamento" class="form-label">Data de Pagamento:</label>
                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="{{ $venda->data_pagamento }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
