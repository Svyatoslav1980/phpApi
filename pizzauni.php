<html>
 <body>
     <form method="post">
     <input type="text" name="internal_reference" value = "SomeOrderIdABC123"/></br>
     <input type="text" name="ssn" value = "100884-470R"/></br>
     <input type="text" name="amount" value = "1053.34"/></br>
     <input type="email" name="email" value = "john.doe@40salus.group"/></br>
     <input type="phone" name="mobile" value = "%2B35846574824"/></br>
     <input type="number" name="product_quantities" value = "1"/></br>
     <input type="text" name="product_names" value = "Apple"/></br>
     <input type="text" name="product_unit_prices" value = "399.99"/></br>
     <input type="text" name="client_ip" value = "127.0.0.1"/></br>
     <input type="submit"/>
     </form>
 </body>
</html>
<?php $internal_reference = $_POST['internal_reference'];
$ssn = $_POST['ssn'];
$amount = $_POST['amount'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$product_quantities = $_POST['product_quantities'];
$product_names = $_POST['product_names'];
$product_unit_prices = $_POST['product_unit_prices'];
$client_ip = $_POST['client_ip'];

$url = 'https://api.salus.group/api/?function=pos&apikey=p-809406-edb3ad8a0a1a122f5c&version=v3&country=fi&domain=pizzauuni.shop&action=register&internal_reference='.$internal_reference.'&type=webshop&ssn='.$ssn.'&amount='.$amount.'&email='.$email.'&mobile='.$mobile.'&product_quantities='.$product_quantities.'&product_names='.$product_names.'&product_unit_prices='.$product_unit_prices.'&client_ip='.$client_ip;
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
$data = json_decode($response);
curl_close($curl);
$redirect_customer_url = $data->response->redirect_customer_url;
echo($redirect_customer_url.'<br>');
echo($url);
$link = '<p><a href="'.$redirect_customer_url.'" >To get a loan, click here</a></p>';
echo($link);
 ?>