<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cadastro</title> 
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastrar Venda</h1>

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id" class="form-label">Cliente:</label>
                <select name="user_id" id="id" class="form-select @error('user_id') is-invalid @enderror">
                    <option value="">Selecione um cliente</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->nome_usuario }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto:</label>
                <input type="text" name="nome_produto" id="nome_produto" class="form-control @error('nome_produto') is-invalid @enderror" value="{{ old('nome_produto') }}">
                @error('nome_produto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor do Produto:</label>
                <input type="text" name="valor" id="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor') }}">
                @error('valor')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento:</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-select">
                    <option value="cartao">Cartão</option>
                    <option value="boleto">Boleto</option>
                    <option value="pix">Pix</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Venda</button>
        </form>
    </div>
</body>
</html>
