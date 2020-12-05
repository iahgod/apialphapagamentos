<?php
$url = 'https://prd-sales.alphapay.com.br/api/Transaction';

$name = 'Iago Vinicios';
$cpf = '12345678914';
$email = "iagovinicios@murano.dev";
$rua = "Cmt Pedro";
$num = "400";
$complemento ="N tem";
$cep = "88395074";
$cidade = "Navegantes";
$estado = "SC";
$pais = "Brasil";
$method = "Credit";
$amount = "1.00";
$installments = "1";
$currency = "BRL";
$cardName = "Iago Vinicios";
$cardNumber = "4824********2113";
$cardAno = "2023";
$cardMes = "12";
$cardCode = "460";
$sellerId = "1073";
$callBackUrl = "";
$softDescriptor = "Iago";
$referenceId ="";
$deviceFingerPrint = "";
$originDomainName ="https://prd-sales.alphapay.com.br/api/Transaction";
$custumerIpAdress = $_SERVER["REMOTE_ADDR"];
$notes = "";
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$data_array = array(
    'customer' => array(
        'name' => $name,
        'birthDate' => '1999-03-25T23:20:50.581Z',
        'document' => $cpf,
        'email' => $email,
        'billingAddress' => array(
            'street' => $rua,
            'number'=> $num,
            'complement' => $complemento,
            'zipCode' => $cep,
            'city' => $cidade,
            'state' => $estado,
            'country' => $pais
        ),
        'deliveryAddress' => array(
            'street' => $rua,
            'number'=> $num,
            'complement' => $complemento,
            'zipCode' => $cep,
            'city' => $cidade,
            'state' => $estado,
            'country' => $pais
        ),
        
    ),
    'payment' => array(
        'method' => $method,
        'amount' => $amount,
        'installments' => $installments,
        'currency' => $currency,
        'card' => array(
            'issuer' => array(
                'name' => 'visa'
            ),
            'holderName' => $name,
            'number' => $cardNumber,
            'expiration' => array(
                'month' => $cardMes,
                'year' => $cardAno,
            ),
            'securityCode' => $cardCode
        )
        ),
    'sellerId' => $sellerId,
    'callbackUrl' => '',
    'softDescriptor' => $softDescriptor,
    'referenceId' => $referenceId,
    'deviceFingerPrint' => $deviceFingerPrint,
    'trackingData' => array(
        'originDomainName' => $originDomainName,
        'customerIpAddress' => $custumerIpAdress
    ),
    'notes' => $notes
);

$body = http_build_query($data_array);

$header = array(
    'Authorization: ApiKey:29342773130A7D2490CCE8F595C8A5C00DD6EB4AF95C085442150C33B9BCABWF',
    'Content-Type:application/json'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$resp = curl_exec($ch);

if($e = curl_error($ch)){
    echo $e;
}else{
    $decoded = json_decode($resp);
    print_r ($resp);
    echo '<br><br>';
    $decode = json_decode($data_array);

    print_r ($decode);
}
curl_close($ch);

