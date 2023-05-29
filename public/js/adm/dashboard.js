function nav_info_adm(url) {

    setInterval(() => {
        $(document).ready(function () {
            $.get(url, function (data) {
                console.log(data.clientes)
                $('#contador-cliente-adm').text(data.clientes);
                $('#contador-loja-adm').text(data.lojas);
            })

        });
    }, 3000);
    // /filtro-venda

}
