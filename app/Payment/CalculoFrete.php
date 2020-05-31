<?php


namespace App\Payment;


class CalculoFrete
{

    public function calculoFrete($cep){


        //add frete
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?&sCepOrigem=75083470&sCepDestino=".$cep."&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=0,&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3p.com",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: XML',
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            dd( $err);
        } else {
            $json = simplexml_load_string($response);
            $my_array = (array)$json;
            $array = (array)$my_array['cServico'];
            $valorFrete = str_replace([','], ['.'], $array['Valor']);
            $valorFrete  = floatval($valorFrete);

        }

        return $valorFrete;
    }
}
