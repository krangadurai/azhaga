<?php
session_start();
require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';
require  '../../assets/includes/security_functions.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';


if (isset($_POST['pdedit'])) {

    $oldPassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $passwordrepeat = $_POST['confirmpassword'];

    if( !empty($oldPassword) && !empty($newpassword) && !empty($passwordrepeat)){

        $sql = "SELECT zha_password FROM zha_users WHERE zha_user_id=?;";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);
            header("Location: ../");
            exit(); 
        }
        else {
                
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['zha_user_id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo"<pre>";
           
            
            
            if($row = mysqli_fetch_assoc($result)){
               
                $pwdCheck = password_verify($oldPassword, $row['zha_password']);
                 
                if ($pwdCheck == false){

                    $_SESSION['ERRORS']['passworderror'] = 'incorrect current password';
                    header("Location: ../");
                    exit();
                }
                if ($oldPassword == $newpassword){

                    echo $_SESSION['ERRORS']['passworderror'] = 'new password cannot be same as old password';
                    header("Location: ../");
                    exit();
                }
                if ($newpassword !== $passwordrepeat){

                    echo $_SESSION['ERRORS']['passworderror'] = 'confirmed password does not match new password';
                    header("Location: ../");
                    exit();
                }

                $passwordUpdated = true;
                
                if ($passwordUpdated == true){
                    
                    $sql = "UPDATE zha_users SET zha_password=? WHERE zha_user_id=?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {

                        $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                        header("Location: ../");
                        exit();
                        
                    } 
                    $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt ,"ss",$hashedPwd,$_SESSION['zha_user_id']);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['ERRORS']['passworderror'] ='sucess!';
                    header("Location: ../");
                }
                // script endpoint --------->>
            }
            
        }
    }
    else{

        $_SESSION['ERRORS']['passworderror'] = 'password fields cannot be empty for password updation';
        header("Location: ../");
        exit();
    }  
} 

/*
 * ------------------------------------------------------------------------------------------------
 *                                 address Update
 * ------------------------------------------------------------------------------------------------
 */


if(isset($_POST['adedit'])){

    foreach ($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }
    if(!verify_csrf_token()){
                    
        $_SESSION['ERROR']['address'] = 'Requst could not be validated';
        header('Location: ../');
        exit();
     }

    $address    = $_POST['address'];
    $city       = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $state      = $_POST['state'];
    $country    = $_POST['country'];

    
   
    if(empty($address)){

        $_SESSION['ERROR']['zha_address'] = 'Address is empty Please Enter ';
    }
    if(empty($city)){

        $_SESSION['ERROR']['zha_city'] = 'City is empty Please Enter ';
    }
    if(empty($postalcode)){

        $_SESSION['ERROR']['zha_postalcode'] = 'Pincode is Please Enter ';
    }
    if(empty($state)){

        $_SESSION['ERROR']['zha_state'] = 'State is Please Enter ';
    }
    if(empty($country)){

        $_SESSION['ERROR']['zha_country'] = 'country is Please Enter ';
    }
    if(strlen($address) >300){

        $_SESSION['ERROR']['zha_address'] = "Only 300 character and less then";
    }
    if(strlen($postalcode)!= 6 ){

        $_SESSION['ERROR']['zha_postalcode'] = 'Enter the Valied Pincode';
    }
    if ( strlen($_SESSION['ERROR']['zha_postalcode']) >0 ||
         strlen($_SESSION['ERROR']['zha_city'])       >0 || 
         strlen($_SESSION['ERROR']['zha_address'])    >0 ||
         strlen($_SESSION['ERROR']['zha_state'])      >0 ||
         strlen($_SESSION['ERROR']['zha_country'])    >0
         ){
        
        header("Location: ../");
        exit();
    }

    $sql = "UPDATE  zha_user_addresses SET zha_address_types='upateaddress' ,zha_user_address=? ,zha_city=? ,zha_state=? ,zha_country=?,zha_Postal_code=? WHERE zha_user_id=? ;";
    $stmt= mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)) {

        echo $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);
        header("Location: ../");
        exit();
    }
    else{

        mysqli_stmt_bind_param($stmt , 'ssssss',$address,$city,$state,$country,$postalcode,$_SESSION['zha_user_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        echo mysqli_stmt_error($stmt);
        $_SESSION['zha_address']      =  $address;
        $_SESSION['zha_postalcode']   =  $postalcode;
        $_SESSION['zha_state']        =  $state;
        $_SESSION['zha_city']         =  $city;
        $_SESSION['zha_country']      =  $country; 

        $_SESSION['status']['address'] = 'Address Resiter sucess';
        header("Location: ../");
        
    }
}


if(isset($_POST['pfedit'])){

    foreach ($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }
    if(!verify_csrf_token()){
                    
        $_SESSION['ERROR']['address'] = 'Requst could not be validated';
        header('Location: ../');
        exit();
     }

    $fullname    = $_POST['fullname'];
    $phone       = $_POST['phone'];
 
    $_SESSION['ERROR']['zha_fullname'] ='';
    $_SESSION['ERROR']['zha_phone']    ='';

    if(empty($fullname)){

        $_SESSION['ERROR']['zha_fullname'] = 'Fullname is empty Please Enter  ';
    }
    if(empty($phone)){

        $_SESSION['ERROR']['zha_phone'] = 'Mobile Number is empty Please Enter  ';
    }
    if(strlen($phone) >10 || strlen($phone) <10 ){

        $_SESSION['ERROR']['zha_phone'] = 'Mobile Number is Enter valided ';
    }

    if ( strlen($_SESSION['ERROR']['zha_fullname']) >0 ||
         strlen($_SESSION['ERROR']['zha_phone'])    >0){

              header("Location: ../");
              exit();
    }

    $sql  = "UPDATE zha_users SET zha_fullname=?, zha_phone=? WHERE zha_user_id=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);
        header("Location: ../");
        exit();
    }
    mysqli_stmt_bind_param($stmt ,"sss",$fullname,$phone,$_SESSION['zha_user_id']);
    mysqli_stmt_execute($stmt);
    echo mysqli_stmt_error($stmt);

    $_SESSION['zha_fullname'] = $fullname;
    $_SESSION['zha_phone']    = $phone;

    $_SESSION['status']['pfedit'] = 'sucess!';
    header("Location: ../");
}

?>