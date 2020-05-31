function proccessPayment(token) {
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        card_birthdate: document.querySelector('input[name=card_birthdate]').value,
        card_cpf: document.querySelector('input[name=card_cpf]').value,
        card_telefone: document.querySelector('input[name=card_telefone]').value,
        card_cep: document.querySelector('input[name=cep]').value,
        card_rua: document.querySelector('input[name=rua]').value,
        card_numero: document.querySelector('input[name=numero]').value,
        card_bairro: document.querySelector('input[name=bairro]').value,
        card_cidade: document.querySelector('input[name=cidade]').value,
        card_uf: document.querySelector('input[name=uf]').value,
        card_complemento: document.querySelector('input[name=complemento]').value,

        _token: csrf,
    };
    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function (res) {
            toastr.success(res.data.message, 'Sucesso');
            window.location.href = `${urlThanks}?order=${res.data.order}`
        }
    });
}

function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function (res) {
            let selectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;
            console.log(res);
        },
        error: function (err) {
            console.log(err)
        },
        complete: function (res) {
            // console.log('Complete: '+ res);
        }
    })
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for(let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x
                                de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }

    select += '</select>';

    return select;
}
