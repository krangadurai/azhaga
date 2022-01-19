<?php
session_start();
require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';
require  '../../assets/vendor/razorpay/Razorpay.php';
require '../../assets/includes/security_functions.php';

$api_key= 'rzp_test_BfLfp8lu7cEMWo';
$api_secret='rdyKvJgTEfgaiQAH63j3KOdL';

use Razorpay\Api\Api;

if  (isset($_POST['confirm'])){

     /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }

    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['resetsubmit'] = 'Request could not be validated';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }else{


         $price  = $_SESSION['zha_totalprice'] *100;
         $api = new Api($api_key, $api_secret);
         $order  = $api->order->create(array('receipt' => 'AZAHGA', 'amount' =>$price , 'currency' => 'INR')); // Creates order
         $orderId = $order['id']; // Get the created Order ID


         $base_url="http://".$_SERVER['SERVER_NAME'];
      
?>
<link rel="stylesheet" href="custom.css">
<div class="pay">
    
        <h4 class="tt" > <a href="../../home"> Azhaga </a></h4>
        <h6 class="tts" >your order is procesing have succes.</h6>
        <h6 class="tts" > your order Id <?php echo $orderId; ?> </h6>
    <button id="rzp-button1" class="rzp-button1">Pay</button>
</div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "<?php echo $api_key; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "<?php echo $_SESSION['zha_productname']; ?>",
        "description": "Test Transaction",
        "image": "https://example.com/your_logo",
        "order_id": "<?php echo $orderId; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "callback_url": "success.php",
        "prefill": {
            "name": "<?php echo $_SESSION['zha_fullname'] ;?>",
            "email": "<?php echo $_SESSION['zha_email'] ;?>",
            "contact": "<?php echo $_SESSION['zha_phone'] ;?>"
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#F37254"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
            alert(response.error.code);
            alert(response.error.description);
            alert(response.error.source);
            alert(response.error.step);
            alert(response.error.reason);
            alert(response.error.metadata);
    });
    
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>

<?php } 
}
else{
    header("Location: ../../home");
}?>