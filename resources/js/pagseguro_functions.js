function proccessPayment(token) {
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        card_birthdate: document.querySelector('input[name=card_birthdate]').value,
        card_cpf: document.querySelector('input[name=card_cpf]').value,
        _token: csrf,
    };

    console.log(data);
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
