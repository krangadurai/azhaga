<?php 
require  '../../assets/vendor/razorpay/Razorpay.php';
require   '../../assets/setup/env.php';
require   '../../assets/setup/db.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';



$api_key= 'rzp_test_BfLfp8lu7cEMWo';
$api_secret='rdyKvJgTEfgaiQAH63j3KOdL';
session_start();
use Razorpay\Api\Api;

$api = new Api($api_key, $api_secret);




if (isset($_POST)) {
     $orderId    = $_POST['razorpay_order_id'];
    $paymentId  = $_POST['razorpay_payment_id'];
    $payment    = $api->payment->fetch($paymentId);
    $order      = $api->order->fetch($orderId);
    //echo '<pre>';
    //print_r($payment);
    //print_r($order); 

    $orderid        = $_POST['razorpay_order_id'];
    $paymentid      = $_POST['razorpay_payment_id'];
    $currency       = $order['currency'];
    $status         = $order['status'];        
    $productid      = $_SESSION['zha_productid'];
    $productname    = $_SESSION['zha_productname'];
    $quantity       = $_SESSION['zha_quantity'];
    $price          = $_SESSION['zha_price'];
    $totalprice     = $_SESSION['zha_totalprice'];
    $userid         = $_SESSION['zha_user_id'];

        

   

    function availableorderId($conn,$orderid){

        $sql='select zha_user_id from zha_orders where zha_order_id=?;';
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
    
            return $_SESSION['ERRORS']['scripterror']='SQL error';
        }
        else{
    
            mysqli_stmt_bind_param($stmt,"s",$orderid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck=mysqli_stmt_num_rows($stmt);
            
            if($resultCheck > 0 ) {
                
                return false;
            }else {
    
                return true;
            }
        }
    
    }
    availableorderId($conn,$orderid);

    if(availableorderId($conn,$orderid)){

        $sql = "INSERT INTO zha_orders 
            ( 	
                zha_order_id, 	
                zha_payment_id, 
                zha_currency,
                zha_status,
                zha_product_id,
                zha_product_name,
                zha_product_quantity,
                zha_product_price,
                zha_product_total_price,
                zha_user_id
                
            )
            VALUES
            (
                '$orderid',
                '$paymentid',
                '$currency',
                '$status',
                '$productid',
                '$productname',
                '$quantity',
                '$price',
                '$totalprice',
                '$userid'
            )";

        mysqli_query($conn,$sql);
        echo mysqli_error($conn);

        $to = $_SESSION['zha_email'];
        $subject = 'Order Success';
                    
        /*
        * -------------------------------------------------------------------------------
        *   Using email template
        * -------------------------------------------------------------------------------
        */
    
        $mail_variables = array();
    
        $mail_variables['product_name']        = $productname;
        $mail_variables['product_price']       = $price;
        $mail_variables['product_quantity']    = $quantity;
        $mail_variables['product_total']       = $totalprice;
        $mail_variables['product_order_id']    = $orderid ;
        $mail_variables['product_payment_id']  = $paymentid;

        $message = file_get_contents("./template_notification.php");
    
        foreach($mail_variables as $key => $value) {
            
            $message = str_replace('{{ '.$key.' }}', $value, $message);
        }
                
                

        $mail = new PHPMailer(true);
    
        try {
    
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port = MAIL_PORT;
    
            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress($to, APP_NAME);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
    
            $mail->send();

        } 
        catch (Exception $e) {
    
            // for public use
            echo $_SESSION['STATUS']['mailstatus'] = 'message could not be sent, try again later';
    
            // for development use
            echo $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;
    
            header("Location: ../");
            exit();
        }



        $mail_variables['use_fullname']        = $_SESSION['zha_fullname'];
        $mail_variables['user_address']        = $_SESSION['zha_address'];
        $mail_variables['user_city']           = $_SESSION['zha_city'];
        $mail_variables['user_State']          = $_SESSION['zha_state'];
        $mail_variables['user_postalcode']     = $_SESSION['zha_postalcode'];
        $mail_variables['user_country']        = $_SESSION['zha_country'];
        $mail_variables['user_Phone']          = $_SESSION['zha_phone'];
        $mail_variables['user_email']          = $_SESSION['zha_email'];
        

        $message = file_get_contents("./template_notification_azhaga.php");
    
        foreach($mail_variables as $key => $value) {
            
            $message = str_replace('{{ '.$key.' }}', $value, $message);
        }

        $mail = new PHPMailer(true);
    
        try {
    
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port = MAIL_PORT;
    
            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress('rangadurai27@gmail.com', APP_NAME);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
    
            $mail->send();

        } 
        catch (Exception $e) {
    
            // for public use
            echo $_SESSION['STATUS']['mailstatus'] = 'message could not be sent, try again later';
    
            // for development use
            echo $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;
    
            header("Location: ../");
            exit();
        }                  
    }
    else{
        
       // header("Location: ../../home");
    }
}else{

    header("Location: ../../home");
}

   
?>
<link rel="stylesheet" href="custom.css">
 <div class="success">
        <a class="stt" href="../../home">Azhaga</a>
        <h6 class="sst">your order is sucess  Thank You!</h6>
         <div class="tik">
              
         </div>
          <a class="slink" href="../../orders">Go Your Orders  Details</a>

</div> 
