let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');

cardNumber.addEventListener('keyup', function () {
    if(cardNumber.value.length >= 6){
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber.value.substr(0,6),
            success: function (res) {
                let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png" style="height: 22px;">`
                spanBrand.innerHTML = imgFlag;
                document.querySelector('input[name=card_brand]').value = res.brand.name;
                getInstallments(amountTransaction , res.brand.name);
            },
            error: function (err) {
                console.log(err)
            },
            complete: function (res) {
                // console.log('Complete: '+ res);
            }
        });
    };
});

let submitButton = document.querySelector('button.processCheckout');

submitButton.addEventListener('click', function (event) {
    event.preventDefault();
    $(".processCheckout").addClass('d-none');
    $("#spinner-pag").removeClass('d-none');


    try {
        PagSeguroDirectPayment.createCardToken({
            cardNumber:         document.querySelector('input[name=card_number]').value,
            brand:              document.querySelector('input[name=card_brand]').value,
            cvv:                document.querySelector('input[name=card_cvv]').value,
            expirationMonth:    document.querySelector('input[name=card_month]').value,
            expirationYear:     document.querySelector('input[name=card_year]').value,
            success: function (res) {
                console.log(res);
                proccessPayment(res.card.token);
            },
            error: function (err) {
                toast.error(msgErros[Object.keys(err.errors)[0]], 10000);
                $('.alert').alert()
                $(".processCheckout").removeClass('d-none');
                $("#spinner-pag").addClass('d-none');
            },
        })
    }
    catch (e) {
       console.log(e.errors);
    }



})

