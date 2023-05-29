function graficoLinha(url = '', id, dados = '', label, tipo = '', prefix = '') {

    var data_at = dados;
    if (tipo == 'Vendas') {
        data_at = dados

    } else if (tipo == 'Valor') {

        data_at = dados
    }

    let chartStatus = Chart.getChart(id); // <canvas> id
    if (chartStatus != undefined) {
        chartStatus.destroy();
    }

    var ctx1 = document.getElementById(id).getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Aug", "Set", "Out", "Nov", "Dez"],
            datasets: [{
                label: label + ' ' + prefix,
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#0098db",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: data_at
                ,
                maxBarThickness: 6
            }],
        },
        options: {
            animation: {
                duration: 0
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });




}

function tabela(data) {

    if (data.length == 0) {
        var response = `<p style="margin-top:100px;" class="text-center justfy-content-center">Não existem regitros para
        serem exbidos!
    </p>`
        $("#user-info-tb-vendas").html(response);

    } else {


        var tabela = `  <div class="table-responsive">
            <table class="table align-items-center "> <tbody>`;

        var content = '';
        data.forEach(element => {
            content += `
                <tr>
                <td class="w-20">
                <div class="d-flex px-2 py-1 align-items-center">


                    <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Codigo</p>
                        <h6 class="text-sm mb-0 text-center">`+ element.codigo + `</h6>
                    </div>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0">Emissão</p>
                    <h6 class="text-sm mb-0">
                        `+ new Date(element.data).toLocaleString() + `</h6>

                </div>
            </td>
            <td>
                <div class="text-center">
                    <p class="text-xs font-weight-bold mb-0">Cliente</p>
                    <h6 class="text-sm mb-0">Consumidor final</h6>
                </div>
            </td>
            <td class="align-middle text-sm">
                <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0">Sub total</p>
                    <h6 class="text-sm mb-0">
                    `+ element.valor_produtos.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }) + `
                        </h6>
                </div>
            </td>
            <td class="align-middle text-sm">
                <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0">Desconto</p>
                    <h6 class="text-sm mb-0">
                        `+ element.desconto.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }) + `</h6>
                </div>
            </td>

            <td class="align-middle text-sm">
                <div class="col text-center">
                    <p class="text-xs font-weight-bold mb-0">Total</p>
                    <h6 class="text-sm mb-0">`+ element.total_nota.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }) + `
                       </h6>
                </div>
            </td>
            </tr>
              `;
        });


        var fim = `
            </tbody>
        </table>
    </div>`;

        $("#user-info-tb-vendas").html(tabela + content + fim);
    }
}
