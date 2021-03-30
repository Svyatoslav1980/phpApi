<?php
$url = 'https://api.salus.group/api/index.php?version=v1&function=getloancost&apikey=p-119510-0b810acacc85eeb255&countrycode=fi&format=json';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json'
    ),
));

$response = curl_exec($curl);
$items = json_decode($response);
curl_close($curl);

$key_monthly = 'Monthly cost';
$key_amount = 'Loan amount';
$amount = 3700;
$year = 5;

foreach($items as &$item){
    $max = $item->$key_amount + 250;
    $min = $item->$key_amount - 250;
    if($item->$key_amount == $amount && $item->Year == $year || $amount < $max && $amount > $item->$key_amount && $item->Year == $year || $amount > $min && $amount < $item->$key_amount && $item->Year == $year){
      echo($item->$key_monthly.'<br>');
    }
}

$number = 23.99678;
echo number_format((float)$number, 2, '.', '');
echo($formatted_number.'<br>');

$json = file_get_contents('loanData.json');
$monthly_data = json_decode($json, true);
$monthly_payment_items = $monthly_data['Taul1'];

foreach($monthly_payment_items as &$item){
    if($item['Summa'] == 100 && $item['Laina-aika kk'] == 12){ 
      echo($item['maksuerä/kk']);
    }
}
?>