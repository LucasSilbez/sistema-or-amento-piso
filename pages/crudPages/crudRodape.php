<?php
include '../../data/crudData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"])) {
    if ($_POST["acao"] == "incluir_rodape") {
        $novoRodape = array(
            'nome' => $_POST['nome'],
            'tamanho_barra' => $_POST['tamanho_barra'],
            'preco_total_barra' => $_POST['preco_total_barra'],
            'cm' => $_POST['cm'],
        );

        inserirDados('rodapes', $novoRodape);
    } elseif ($_POST["acao"] == "excluir_rodape") {
        $idExcluir = $_POST['id'];
        excluirDados('rodapes', $idExcluir);
    } elseif ($_POST["acao"] == "atualizar_rodape") {
        $idAtualizar = $_POST['id'];
        $rodapeAtual = obterRegistroPorId('rodapes', $idAtualizar);

        
    } elseif ($_POST["acao"] == "executar_atualizacao_rodape") {
        $idAtualizar = $_POST['id'];
        $dadosAtualizados = array(
            'nome' => $_POST['nome_atualizado'],
            'tamanho_barra' => $_POST['tamanho_barra_atualizado'],
            'preco_total_barra' => $_POST['preco_total_barra_atualizado'],
            'cm' => $_POST['cm_atualizado'],
        );

        atualizarDados('rodapes', $idAtualizar, $dadosAtualizados);
    }
}

$laminados = listarDados('laminados');
$vinilicos = listarDados('vinilicos');
$rodapes = listarDados('rodapes');
$acessorios = listarDados('acessorios');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Rodapés</title>
    <link rel="stylesheet" href="../../css/crud.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["acao"] == "atualizar_rodape"): ?>

    <form method="post" action="" class="mb-4" id="formularioAtualizacao">
        <h3>Atualizar Rodapé (USAR PONTO AO INVÉS DE VIRGULA)</h3>
        <input type="hidden" name="acao" value="executar_atualizacao_rodape">
        <input type="hidden" name="id" value="<?php echo $rodapeAtual['id']; ?>">
        <div class="form-group">
            <label for="nome_atualizado">Nome:</label>
            <input type="text" name="nome_atualizado" value="<?php echo $rodapeAtual['nome']; ?>" class="form-control"
                required>
        </div>
        <div class="form-group">
            <label for="tamanho_barra_atualizado">Tamanho da Barra:</label>
            <input type="text" name="tamanho_barra_atualizado" value="<?php echo $rodapeAtual['tamanho_barra']; ?>"
                class="form-control" required>
        </div>
        <div class="form-group">
            <label for="preco_total_barra_atualizado">Preço Total da Barra:</label>
            <input type="text" name="preco_total_barra_atualizado"
                value="<?php echo $rodapeAtual['preco_total_barra']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cm_atualizado">Cm:</label>
            <input type="text" name="cm_atualizado" value="<?php echo $rodapeAtual['cm']; ?>" class="form-control"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <button type="button" class="btn btn-secondary" onclick="cancelarAtualizacao()">Cancelar</button>
    </form>
    <?php endif; ?>

    <script>
    function cancelarAtualizacao() {
        document.getElementById("formularioAtualizacao").style.display = "none";
    }
    </script>

    <div id="listProd">

        <h3>Rodapés</h3>

        <ul class="list-group">
            <?php foreach ($rodapes as $rodape): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="flex-fill">
                    <?php echo "{$rodape['nome']} - {$rodape['tamanho_barra']} - R$ {$rodape['preco_total_barra']}"; ?>
                </div>
                <form method="post" action="" class="ml-2">
                    <input type="hidden" name="acao" value="excluir_rodape">
                    <input type="hidden" name="id" value="<?php echo $rodape['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
                <form method="post" action="" class="ml-2">
                    <input type="hidden" name="acao" value="atualizar_rodape">
                    <input type="hidden" name="id" value="<?php echo $rodape['id']; ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                </form>
            </li>
            <?php endforeach; ?>
        </ul>


        <h3 class="mt-4">Incluir novo rodapé (USAR PONTO AO INVÉS DE VIRGULA)</h3>
        <form method="post" action="" class="mb-4 text-white">
            <input type="hidden" name="acao" value="incluir_rodape" class="form-control">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tamanho_barra">Tamanho da Barra:</label>
                <input type="text" name="tamanho_barra" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="preco_total_barra">Preço Total da Barra:</label>
                <input type="text" name="preco_total_barra" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cm">Cm: (Necessário para cálculo de mão de obra, caso menor que 10cm, informar 10cm)</label>
                <input type="text" name="cm" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Incluir</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>