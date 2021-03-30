<?php global $woocommerce;
$user_id = get_current_user_id(); // The current user ID

    // Get the WC_Customer instance Object for the current user
    $customer = new WC_Customer( $user_id );

    // Get the last WC_Order Object instance from current customer
    $last_order = $customer->get_last_order();
if (empty($last_order)){ echo('No order');}else{
    $order_id = $last_order->get_id(); // Get the order id
    $order_data = $last_order->get_data(); // Get the order unprotected data in an array
    $order_status = $last_order->get_status();// Get the order status
    $order_email = $order_data['billing']['email'];
    $total= $order_data['total'];
    $phone='%2B'.$order_data['billing']['phone'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $ssn = $_POST['ssn'];
    $product_quantities="";
    $product_names="";
    $product_unit_prices="";
    
    $order_items=$last_order->get_items();
foreach( $order_items as $item_id => $item ){
      if(!next($order_items)){
   $item_data = $item->get_data();
   $product_names .= $item_data['name'];
   $product_quantities .= $item_data['quantity'];
   $product_unit_prices .= $item_data['total'];
   }else{
   $item_data = $item->get_data();
   $product_names .= $item_data['name'].'%7C';
   $product_quantities .= $item_data['quantity'].'%7C';
   $product_unit_prices .= $item_data['total'].'%7C';
}
}

if(array_key_exists('loan_submit',$_POST)){
$url = 'https://api.salus.group/api/?function=pos&apikey=p-809406-edb3ad8a0a1a122f5c&version=v3&country=fi&domain=pizzauuni.shop&action=register&internal_reference='.$order_id.'&type=webshop&ssn='.$ssn.'&amount='.$total.'&email='.$order_email.'&mobile='.$phone.'&product_quantities='.$product_quantities.'&product_names='.$product_names.'&product_unit_prices='.$product_unit_prices.'&client_ip='.$ip.'&return_url=https://pizzauuni.shop/checkout/';
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
echo($url.'<br>');
echo($redirect_customer_url);
}
}
?>
<html>
 <body>
     <form method="post">
     <input type="text" name="ssn" required placeholder="Enter Your ssn" value = <?php echo($ssn); ?>></br>
     <input type="text" name="product_quantities" value = <?php echo($product_quantities); ?>></br>
     <input type="text" name="product_names" value = <?php echo($product_names); ?>></br>
     <input type="text" name="product_unit_prices" value = <?php echo($redirect_customer_url); ?>></br>
     <input type="submit" name="loan_submit" id="loan_submit"/>
     </form>
 </body>
</html>