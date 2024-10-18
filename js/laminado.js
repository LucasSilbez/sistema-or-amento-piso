async function getProdutosFromPHP() {
    const response = await fetch('../../data/fetchJson.php'); // Substitua pelo caminho correto
    return response.json();
}

async function popularSelectFromPHP(tipoProduto) {
    const selectElement = document.getElementById(tipoProduto);
    const produtosDoTipo = await getProdutosFromPHP();

    produtosDoTipo[tipoProduto].forEach((produto) => {
        const option = document.createElement("option");
        option.value = produto.id;
        option.text = produto.nome;
        selectElement.appendChild(option);
    });
}

popularSelectFromPHP("laminados");
popularSelectFromPHP("rodapes");
popularSelectFromPHP("acessorios");



async function gerarOrcamento() {
    const laminadoId = document.getElementById("laminados").value;

    const quantidadeLaminadoTotalOriginal = parseFloat(document.getElementById("metragemTotal").value);
    const metragemLinearOriginal = parseFloat(document.getElementById("metragemLinear").value);

    let increasePercentageML = 0.15; // Aumento padrão é de 15%

    let increasePercentageM2 = 0.15; // Aumento padrão é de 15%

    if (document.getElementById("increase10PercentML").checked) {
        increasePercentageML = 0.10;
    }

    if (document.getElementById("increase10PercentM2").checked) {
        increasePercentageM2 = 0.10;
    }

    const quantidadeLaminadoTotal = Math.round(quantidadeLaminadoTotalOriginal * (1 + increasePercentageM2));
    const metragemLinear = Math.round(metragemLinearOriginal * (1 + increasePercentageML));

    const rodapeId = document.getElementById("rodapes").value;

    const produtosPHP = await getProdutosFromPHP();

    const precoLaminado = produtosPHP.laminados.find(produto => produto.id == laminadoId)["preco_total_caixa"];
    const precoRodape = produtosPHP.rodapes.find(produto => produto.id == rodapeId)["preco_total_barra"];
    const valorCmRodape = produtosPHP.rodapes.find(produto => produto.id == rodapeId)["cm"];


    const metragemPorCaixa = produtosPHP.laminados.find(produto => produto.id == laminadoId)["metragem_embalagem_cx"];
    let quantidadeCaixas = quantidadeLaminadoTotal / metragemPorCaixa;
    quantidadeCaixas = Math.round(quantidadeCaixas);


    const quantidadeManta = Math.round(quantidadeLaminadoTotal / 10);


    let quantidadeCola1_5kg = 0;
    let quantidadeCola5kg = 0;
    
    const rodapeSelecionado = produtosPHP.rodapes.find(produto => produto.id == rodapeId);
    if (rodapeSelecionado && !rodapeSelecionado.cordao) {
        const rendimentoPorCola1_5kg = 20;
        const rendimentoPorCola5kg = 5 * (20 / 1.5); // Cola de 5kg tem rendimento proporcional ao de 1.5kg
    
        if (metragemLinear <= 40) {
            // Use cola de 1,5 kg
            quantidadeCola1_5kg = Math.ceil (metragemLinear / rendimentoPorCola1_5kg);
        } else {
            // Use cola de 5kg
            quantidadeCola5kg = Math.ceil (metragemLinear / rendimentoPorCola5kg);
        }
    }

    const quantidadePacotePregos = 1;


    const custoManta = quantidadeManta * produtosPHP.acessorios.find(produto => produto.nome == "Manta acrílica 2mm")["preco"];
    const custoCola1_5kg = quantidadeCola1_5kg * produtosPHP.acessorios.find(produto => produto.nome == "Cola para rodapé Persipisos 1.5kg")["preco"];
    const custoCola5kg = quantidadeCola5kg * produtosPHP.acessorios.find(produto => produto.nome == "Cola para rodapé Persipisos 5kg")["preco"];
    const custoPacotePregos = quantidadePacotePregos * produtosPHP.acessorios.find(produto => produto.nome == "Pacote Pregos")["preco"];
    var custoMaoDeObraData = quantidadeLaminadoTotalOriginal * produtosPHP.acessorios.find(produto => produto.nome == "Mão de obra piso laminado")["preco"];
    const custoMaoDeObraMinData = produtosPHP.acessorios.find(produto => produto.nome == "Valor mínimo de mão de obra laminado")["preco"];
    const custoLucroData = produtosPHP.acessorios.find(produto => produto.nome == "Lucro")["preco"];
    const custoJurosData = produtosPHP.acessorios.find(produto => produto.nome == "Juros cartão de crédito")["preco"];
    var custoFrete = produtosPHP.acessorios.find(produto => produto.nome == "Frete")["preco"];

    if (custoMaoDeObraData <= 250) {
        custoMaoDeObraData = custoMaoDeObraMinData
    }


    const tamanhoBarra = produtosPHP.rodapes.find(produto => produto.id == rodapeId)["tamanho_barra"];
    let quantidadeBarras = metragemLinear / tamanhoBarra;
    quantidadeBarras = Math.round(quantidadeBarras);
    const custoRodapes = quantidadeBarras * precoRodape;


    const custoLaminados = quantidadeCaixas * precoLaminado;


    let quantidadePerfilRedutor = parseFloat(document.getElementById("quantidadePerfilRedutor").value);
    if (isNaN(quantidadePerfilRedutor)) {
        quantidadePerfilRedutor = 0;
    }
    const precoPerfilRedutor = produtosPHP.acessorios.find(produto => produto.nome === "Perfil Redutor / T")["preco"];
    const custoPerfilRedutor = quantidadePerfilRedutor * precoPerfilRedutor;


    const cordaoId = produtosPHP.rodapes.find(produto => produto.nome === "Eucafloor Cordão Estilo")?.id;
    let quantidadeCordao = parseFloat(document.getElementById("quantidadeCordao").value);
    if (isNaN(quantidadeCordao)) {
        quantidadeCordao = 0;
    }
    const precoCordao = produtosPHP.rodapes.find(produto => produto.id == cordaoId)["preco_total_barra"];
    const custoCordao = quantidadeCordao * precoCordao;


    // let custoMaoDeObra = 25 * quantidadeLaminadoTotalOriginal; 


    const custoMaoDeObraCordao = metragemLinearOriginal * valorCmRodape; // atualizado aqui

    

    if (custoLaminados + custoRodapes + custoManta + custoCola1_5kg + custoCola5kg + custoPacotePregos + custoPerfilRedutor + custoCordao >= 1000) { // atualizado aqui

        custoFrete = 0; // atualizado aqui

    } else { // atualizado aqui
        custoFrete = custoFrete; // atualizado aqui
    } // atualizado aqui


    const subtotal = custoLaminados + custoRodapes + custoManta + custoCola1_5kg + custoCola5kg + custoPacotePregos + custoMaoDeObraData + custoMaoDeObraCordao + custoPerfilRedutor + custoCordao + custoFrete;

    const totalLucro = subtotal * (1 + (custoLucroData / 100));

    const lucro = totalLucro - subtotal;

    const cartao = totalLucro * (1 + (custoJurosData / 100)); 


    const tabelaOrcamento = document.getElementById("tabelaOrcamento");
    tabelaOrcamento.innerHTML = `
<div id="tableContainer" class="table-responsive">
    <table id="resultadoOrcamento" class="table table-bordered table-striped">
    <h2>Resultado Orçamento</h2>
        <thead>
            <tr id="destaque">
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Caixas de ${produtosPHP.laminados.find(produto => produto.id == laminadoId).nome}</td>
                <td>${quantidadeCaixas.toFixed(0)}</td>
                <td>${custoLaminados.toFixed(2)}</td>
            </tr>
            <tr>
                <td>${produtosPHP.rodapes.find(produto => produto.id == rodapeId).nome} (${produtosPHP.rodapes.find(produto => produto.id == rodapeId).cm} cm)</td>
                <td>${quantidadeBarras.toFixed(0)}</td>
                <td>${custoRodapes.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Manta acrílica 2mm</td>
                <td>${quantidadeManta}</td>
                <td>${custoManta.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Cola para rodapé (1.5kg)</td>
                <td>${quantidadeCola1_5kg}</td>
                <td>${custoCola1_5kg.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Cola para rodapé (5kg)</td>
                <td>${quantidadeCola5kg}</td>
                <td>${custoCola5kg.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Pacote de pregos</td>
                <td>${quantidadePacotePregos}</td>
                <td>${custoPacotePregos.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Mão de obra</td>
                <td>Para ${quantidadeLaminadoTotalOriginal.toFixed(0)}m²</td>
                <td>${custoMaoDeObraData.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Mão de obra rodapé</td>
                <td>Para ${valorCmRodape.toFixed(0)}cm</td>
                <td>${custoMaoDeObraCordao.toFixed(2)}</td>
            </tr>
            <tr>
            <td>Frete</td>
            <td>-</td>
            <td>${custoFrete.toFixed(2)}</td>
        </tr>
           
            <tr>
                <td>${produtosPHP.acessorios.find(produto => produto.nome === "Perfil Redutor / T").nome}</td>
                <td>${quantidadePerfilRedutor.toFixed(0)}</td>
                <td>${custoPerfilRedutor.toFixed(2)}</td>
            </tr>
            <tr>
                <td>${produtosPHP.rodapes.find(produto => produto.nome === "Eucafloor Cordão Estilo").nome}</td>
                <td>${quantidadeCordao.toFixed(0)}</td>
                <td>${custoCordao.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td>-</td>
                <td>${subtotal.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Lucro</td>
                <td>${custoLucroData.toFixed(0)}%</td>
                <td>${lucro.toFixed(2)}</td>
            </tr>
            <tr id="destaque">
                <td colspan="2"><strong>Total</strong></td>
                <td>${totalLucro.toFixed(2)}</td>
            </tr>
            <tr>
                <td>Total no cartão</td>
                <td>${custoJurosData.toFixed(0)}%</td>
                <td>${cartao.toFixed(2)}</td>
            </tr>
        </tbody>
    </table>
</div>
`;
    tabelaOrcamento.style.display = 'block';

}
