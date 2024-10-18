<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento de Rodapé</title>
    <link rel="stylesheet" href="../../css/orcamentos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand text-white" href="../../index.php"><img id="logo" src="../../assets/logo.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style=" filter: invert(100%);"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="../../index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="../orcamentoPages/orcLaminado.php">Orçamento Laminado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="../orcamentoPages/orcRodape.php">Orçamento Rodapé</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="../orcamentoPages/orcVinilico.php">Orçamento Vinílico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="../crudPages/crudOptions.php">Atualizar produtos</a>
            </li>
        </ul>
    </div>
</nav>

<body class="container mt-5">



    <div id="tabelaOrcamento" style="display: none;">
        <table id="resultadoOrcamento" class="table"></table>
    </div>

    <div id="formContainer">
        <form id="orcamentoForm" class="mb-5 text-white">
            <h2 class="mb-4">Formulário de Orçamento Rodapés</h2>

            <div class="form-group">
                <label for="rodapes">Rodapés:</label>
                <select id="rodapes" name="rodapes" class="form-control"></select>
            </div>

            <div class="form-group">
                <label for="quantidadeCordao">Quantidade de Cordão:</label>
                <input type="number" id="quantidadeCordao" name="quantidadeCordao" class="form-control">
            </div>

            <div class="form-group">
                <label for="metragemLinear">Metragem Linear:</label>
                <input type="number" id="metragemLinear" name="metragemLinear" class="form-control" required>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="increase10Percent" name="increase10Percent">
                <label class="form-check-label" for="increase10Percent">+10%</label>
            </div>

            <div class="form-check form-check-inline mb-2">
                <input class="form-check-input" type="checkbox" id="increase15Percent" name="increase15Percent">
                <label class="form-check-label" for="increase15Percent">+15%</label>
            </div>

            <button id="gerarButton" class="btn btn-primary mt-3 btn-block" type="button"
                onclick="gerarOrcamentoRodape()">Gerar
                Orçamento</button>
        </form>
    </div>


    <div id="tabelaOrcamento" style="display: none;"></div>

    <script src="../../js/rodape.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>