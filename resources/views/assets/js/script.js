function Aux(config) {
    const http = new XMLHttpRequest();
    http.open(config.method, config.url, config.flag);
    http.setRequestHeader("x-csrf-token", config.csrf_token);
    http.onreadystatechange = function(e) {
        if (http.readyState === 4 && http.status === 200) {
            let response = http.responseText;
            const center = document.getElementById(config.idName);
            center.innerHTML = (response.length >= 2) ? response : "0"+response;
        }
    }
    http.send();
}

var inputAdicionar = document.getElementById('adicionar');
var inputPendentes = document.getElementById('qnt_pendente');
var inputTotalPagos = document.getElementById('total_pagos');
var inputTotalVendas = document.getElementById('total_todos_pedidos');
var inputValorUnitario = document.getElementById('valor_unitario');
var inputValorTotalPendente = document.getElementById('valor_total_pendente');
// var inputValorTotalPago = document.getElementById('valor_total_pagos');
// var inputValorTotal = document.getElementById('valor_total_todos_pedidos');
var inputValorVenda = document.getElementById('valor_da_venda');
var inputQuantidadeCompra = document.getElementById('qnt_compra');

function calcular() {
    if (isNaN(parseFloat(inputValorUnitario.value))) {
        inputValorUnitario.style = "border: 1px solid red";
        inputValorUnitario.focus();
    } else {
        inputValorUnitario.style = "";
        if(inputPendentes.value === "" || inputPendentes.value === null) {
            inputPendentes.style = "border: 1px solid red";
            inputPendentes.focus();
        }else{
            inputPendentes.style = "";
            if (isNaN(parseInt(inputAdicionar.value) + parseInt(inputPendentes.value))) {
                inputAdicionar.style = "border: 1px solid red";
                inputAdicionar.focus();
            }else {
                inputAdicionar.style = "";
                inputPendentes.value = parseInt(inputAdicionar.value) + parseInt(inputPendentes.value);

                if (isNaN(parseFloat(parseFloat(inputValorUnitario.value) * parseInt(inputPendentes.value)))) {
                    inputAdicionar.style = "border: 1px solid red";
                    inputAdicionar.focus();
                } else {
                    inputAdicionar.style = "";
                    let auxQuantidadeAdicionar = inputAdicionar.value;
                    inputQuantidadeCompra.value = parseInt(auxQuantidadeAdicionar) + parseInt(inputQuantidadeCompra.value);

                    let saveValuePendente = parseFloat(inputValorTotalPendente.value.replace(',', '.').replace('R$', ''));
                    let saveCalcNewValuePendente  = parseFloat(inputValorUnitario.value.replace(',', '.')) * parseInt(inputAdicionar.value);

                    inputValorTotalPendente.value = `R$ ${parseFloat(saveCalcNewValuePendente + saveValuePendente)}`;

                    inputTotalVendas.value = parseInt(inputTotalPagos.value) + parseInt(inputPendentes.value);
                    //inputValorTotal.value = `R$ ${parseFloat(parseFloat(inputValorTotalPendente.value.replace(',', '.').replace('R$', '')) + parseFloat(inputValorTotalPago.value.replace(',', '.').replace('R$', '')))}`;

                    let valorAtualVenda = parseFloat(inputValorVenda.value.replace(',', '.').replace('R$', ''));
                    let auxCalcVenda = parseFloat(inputValorUnitario.value.replace(',', '.')) * parseInt(inputAdicionar.value);
                    inputValorVenda.value = `R$ ${parseFloat(parseFloat(auxCalcVenda) + parseFloat(valorAtualVenda))}`;
                }
            }
        }
    }
}
var path = document.location.pathname.split('/');
var url = document.getElementsByName('url_panel')[0].content+"/";
if (path[2] == "home") {
    Aux({
        "method": "POST",
        "url": url+"getters-clients",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "total_clients"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-sales",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "total_sales"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-sales-completed",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "total_sales-completed"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-sales-pending",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "total_sales-pending"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-value-total",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "valor_total_all"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-value-pending",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "valor_total_pendente"
    });

    Aux({
        "method": "POST",
        "url": url+"getters-value-pago",
        "flag": true,
        "csrf_token": document.getElementsByName("csrf-token-1")[0].content,
        "idName": "valor_total_pago"
    });
}
