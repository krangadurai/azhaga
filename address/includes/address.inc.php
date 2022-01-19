<?php
session_start();
require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';
require '../../assets/includes/security_functions.php';
$userid   = $_SESSION['zha_user_id'];

    if(isset($_POST['addaddress'])){

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

        $_SESSION['ERROR']['zha_address']    = '';
        $_SESSION['ERROR']['zha_city']       = '';
        $_SESSION['ERROR']['zha_postalcode'] = '';
        $_SESSION['ERROR']['zha_state']      = '';
        $_SESSION['ERROR']['zha_country']    = '';
       
        if(empty($address)){

            $_SESSION['ERROR']['zha_address'] = 'Address is empty Enter The valided ';
        }
        if(empty($city)){

            $_SESSION['ERROR']['zha_city'] = 'City is empty Enter the valided ';
        }
        if(empty($postalcode)){

            $_SESSION['ERROR']['zha_postalcode'] = 'Pincode is Empty Enter the valided ';
        }
        if(empty($state)){

            $_SESSION['ERROR']['zha_state'] = 'State is Empty Enter the valided ';
        }
        if(empty($country)){

            $_SESSION['ERROR']['zha_country'] = 'country is Empty Enter the valided ';
        }
        if(strlen($address) >300){

            $_SESSION['ERROR']['zha_address'] = "Only 300 character and less then";
        }
        if(strlen($postalcode)!= 6 ){

            $_SESSION['ERROR']['zha_postalcode'] = 'Enter the Valied Pincode';
        }

        function errorcheck($data){
            foreach($data as $value => $key){
              
                if( strlen($key) > 0 ){
               
                    return true;
                 }
            }
           
        }

        $error= errorcheck($_SESSION['ERROR']);
        if($error == true){

            header("Location: ../../address");
            exit();
        }


    
        $sql = "INSERT INTO zha_user_addresses (zha_user_id,zha_address_types ,zha_user_address ,zha_city ,zha_state ,zha_country,zha_Postal_code) 
        values ( ?,'shipping',?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)) {

            $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);
            header("Location: ../");
            exit();
        }
        else{

            mysqli_stmt_bind_param($stmt , 'ssssss',$userid,$address,$city,$state,$country,$postalcode);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            echo mysqli_stmt_error($stmt);
            $_SESSION['zha_address']      =  $address;
            $_SESSION['zha_city']         =  $city;
            $_SESSION['zha_postalcode']   =  $postalcode;
            $_SESSION['zha_state']        =  $state;
            $_SESSION['zha_country']      =  $country; 

            $_SESSION['status']['address'] = 'Address Resiter sucess';
            header("Location: ../../home");
            
        }
    }
?>