function nav_info(url) {
    
    setInterval(() => {
        $(document).ready(function () {
            $.get(url, function (data) {

                $('#ultima-atualizacao').text('Ultima atualização ' + new Date(data.data).toLocaleString());
                $('#nome-loja').text(data.nome[0].nome_loja);
                $('#cnpj-loja').text(data.cnpj[0].cnpj_loja);
                $('#user-venda-info').text(data.venda.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }));

                $('#ultima-atualizacao').text('Ultima atualização ' + new Date(data.data)
                    .toLocaleString());

                $('#user-venda-info').text(data.venda.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-caixa-info').text(data.caixa.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-caixa-info-atual').text(data.caixaAtual.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-estoque-info').text(data.estoque.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2
                }));

                $('#user-cred-info').text((data.forma_pagamento[0].meio_cartaocred ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-dinheiro-info').text((data.forma_pagamento[0].meio_dinheiro ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-deb-info').text((data.forma_pagamento[0].meio_cartaodeb ? data.forma_pagamento[0].meio_cartaodeb : 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-pix-info').text((data.forma_pagamento[0].meio_outros ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-chequeav-info').text((data.forma_pagamento[0].meio_chequeav ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-chequeap-info').text((data.forma_pagamento[0].meio_chequeap ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-crediario-info').text((data.forma_pagamento[0].meio_crediario ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));
                $('#user-total-dia-info').text((data.total_diario ?? 0).toLocaleString('pt-BR', {
                    // minimumFractionDigits: 2
                    style: 'currency',
                    currency: 'BRL'
                }));

                tabela(data.vendas_diaria)
                graficoLinha(url, "chart-line-vendas-qtd", JSON.parse(data.meses),
                    'Vendas', 'Vendas');
                graficoLinha(url, "chart-line-vendas-valor", JSON.parse(data.valor),
                    'Vendas', 'Valor',
                    'R$')
            })

        });
    }, 3000);
    // /filtro-venda


}

