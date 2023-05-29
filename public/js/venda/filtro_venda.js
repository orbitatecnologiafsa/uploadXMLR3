function filtro_vendas(url) {
    $(document).ready(function () {
        $('#select_venda_var').hide();
        $.get(url, function (data) {
            var filtro_venda = data['filtro_venda']
            filtro_venda.map(({
                campo,
                valor
            }) => {
                if (getParam('op_filtro_venda') == valor) {
                    if (valor == 'nome_vendedor') {
                        $('#campo_venda').hide();
                        $('#select_venda_var').show();
                    }
                    $('#filtro_vendas').append(`<option selected value='${valor}'>${campo}</option>`);
                } else {
                    $('#filtro_vendas').append(`<option value='${valor}'>${campo}</option>`);

                }
            });
        })
    });
}

function getParam(param) {
    var url_string = window.location.href;
    var url = new URL(url_string);
    return url.searchParams.get(param); //pega o value
}

function vendedores(url) {
    $(document).ready(function () {
        $.get(url, function (data) {
            var val = data['filtro_vendedor']
            val.map(({
                nome_vendedor,
                codigo_vendedor
            }) => {
                if (getParam('op_filtro_vendedor') == codigo_vendedor) {
                    $('#filtro_vendedor').append(`<option selected  value='${codigo_vendedor}'>${nome_vendedor}</option>`);
                } else {
                    $('#filtro_vendedor').append(`<option  value='${codigo_vendedor}'>${nome_vendedor}</option>`);
                }
            });
        });
    });
}


function mostrarOcultar() {
    $(document).ready(function () {
        $('#filtro_vendas').change(function () {
            var valorSelecionado = $(this).val();

            if (valorSelecionado == 'nome_vendedor') {
                $('#campo_venda').hide();
                $('#select_venda_var').show();
            } else {
                // Esconder o seletor e exibir o campo de entrada
                $('#campo_venda').show();
                $('#select_venda_var').hide();
            }
        });
    });
}


function limparVar() {
    // Obtém a URL atual

    if (getParam('op_filtro_vendedor') != '') {
        var url = window.location.href;

        // Verifica se o parâmetro existe na URL
        if (url.indexOf('?') !== -1) {
            // Obtém a parte da URL após o ponto de interrogação
            var queryString = url.split('?')[1];

            // Cria um array com os pares chave-valor
            var params = queryString.split('&');

            // Remove o valor da variável desejada
            params = params.filter(function (param) {
                return !param.startsWith('op_filtro_vendedor=');
            });

            // Reconstroi a URL sem o valor da variável
            var newUrl = url.split('?')[0] + '?' + params.join('&');

            // Atualiza a URL no navegador
            window.history.replaceState({}, '', newUrl);
        }
    }

}
