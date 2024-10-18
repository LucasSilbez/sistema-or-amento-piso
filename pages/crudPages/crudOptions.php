<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar produtos</title>
    <link rel="stylesheet" href="../../css/crudOptions.css">
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

<body>
    <div class="container">
        <h3 class="mt-1" id="crudH3">Atualizar informações e preços de produtos</h3>
        <div class="orcButtons mt-5">
            <a href="../crudPages/crudLaminado.php" class="btn btn-primary">Laminado</a>
            <a href="../crudPages/crudVinilico.php" class="btn btn-primary">Vinílico</a>
            <a href="../crudPages/crudRodape.php" class="btn btn-primary">Rodapé</a>
            <a href="../crudPages/crudAcessorios.php" class="btn btn-primary">Acessórios / Outros</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>