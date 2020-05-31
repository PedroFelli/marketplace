<?php


namespace App\Payment\PagSeguro;


use App\Payment\CalculoFrete;

class CreditCard
{
    private $items;
    private $user;
    private $cardInfo;
    private $reference;
    private $senderAdress;

    public function __construct($items, $user, $cardInfo, $senderAddress, $reference){
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
        $this->senderAdress = $senderAddress;
    }

    public function doPayment(){
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();


        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference(base64_encode($this->reference));
        $creditCard->setCurrency("BRL");


        $valorFrete = new CalculoFrete();
        $valorFrete = $valorFrete->calculoFrete($this->senderAdress['cep']);
        //add valor do frete
        $creditCard->setExtraAmount($valorFrete);

        //add valor do frete
        $creditCard->setExtraAmount($valorFrete);


        foreach ($this->items as $item){
            $creditCard->addItems()->withParameters(
                $item['id'],
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($this->cardInfo['card_name']);
        $creditCard->setSender()->setEmail($email);

        list($areaCode, $number) = explode('-', $this->cardInfo['card_telefone']);


        $creditCard->setSender()->setPhone()->withParameters(
            $areaCode,
            $number
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            $this->cardInfo['card_cpf']
        );

        $creditCard->setSender()->setHash($this->cardInfo['hash']);
        $creditCard->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $creditCard->setShipping()->setAddress()->withParameters(
            $this->senderAdress['rua'],
            $this->senderAdress['numero'],
            $this->senderAdress['bairro'],
            $this->senderAdress['cep'],
            $this->senderAdress['cidade'],
            $this->senderAdress['uf'],
            'BRA',
            $this->senderAdress['complemento']
        );

        //Set billing information for credit card
        $creditCard->setBilling()->setAddress()->withParameters(
            $this->cardInfo['card_rua'],
            $this->cardInfo['card_numero'],
            $this->cardInfo['card_bairro'],
            $this->cardInfo['card_cep'],
            $this->cardInfo['card_cidade'],
            $this->cardInfo['card_uf'],
            'BRA',
            $this->cardInfo['card_complemento']
        );

        // Set credit card token
        $creditCard->setToken($this->cardInfo['card_token']);
        list($quantity, $installmentAmout) = explode('|', $this->cardInfo['installment']);
        $installmentAmout = number_format($installmentAmout, 2, '.', '');
        $creditCard->setInstallment()->withParameters($quantity,$installmentAmout);

        // Set the credit card holder information
        $creditCard->setHolder()->setBirthdate($this->cardInfo['card_birthdate']);
        $creditCard->setHolder()->setName($this->cardInfo['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            $areaCode,
            $number
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            $this->cardInfo['card_cpf']
        );


        $creditCard->setMode('DEFAULT');

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    }

}
