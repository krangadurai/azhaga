<?php

session_start();

require '../../assets/includes/auth_functions.php';
require '../../assets/includes/datacheck.php';
require '../../assets/includes/security_functions.php';

check_logout();


if (isset($_POST['signupsubmit']) && isset($_POST['terms'])) {

    /*
     * -------------------------------------------------------------------------------
     *   Securing against Header Injection
     * -------------------------------------------------------------------------------
     */

     foreach ($_POST as $key => $value){

         $_POST[$key] = _cleaninjections(trim($value));
     }

    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

     if(!verify_csrf_token()){
                        
        $_SESSION['STATUS']['signupstatus'] = 'Requst could not be validated';
        header('Location: ../');
        exit();
     }



     require '../../assets/setup/db.inc.php';
     
     //filter POST data
     function input_filter($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
     }

     $fullname = input_filter($_POST['name']);
     $email    = input_filter($_POST['email']);
     $phone    = input_filter($_POST['phone']);
     $pass     = input_filter($_POST['password']);
     $conpass  = input_filter($_POST['confirm_password']);
     $terms    = input_filter($_POST['terms']);
    /*
    * -------------------------------------------------------------------------------
    *   Data Validation
    * -------------------------------------------------------------------------------
    */


   
   
    if ( empty($fullname) || empty($email) || empty($phone) || empty($pass) || empty($conpass)) {

        $_SESSION ['ERRORS'] ['formerror'] = 'required field cannot be empty,try again';
        header('location: ../');
        exit();
        
    }
    elseif (!preg_match("/^[a-zA-Z]*$/",$fullname)) {
        
        $_SESSION['ERRORS']['nameerror'] = 'Invalid Name';
        header("Location: ../");
        exit();
    }
    elseif (!preg_match('/^\d{10}$/', $phone)) {
        
        $_SESSION['ERRORS']['phoneerror'] = 'Invalid Mobile Number';
        header("Location: ../");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         
        $_SESSION['ERRORS']['emailerror'] = $email ."Invalid Email Address";
    //    header("Location: ../");
        exit();
    }
    elseif ($pass !== $conpass){

        $_SESSION['ERRORS']['passworderror'] = 'Password Donot Match';
        header("Location: ../");
        exit();
    }
    else{

     

        // if (availablePhone($conn,$phone)){

        //     $_SESSION['ERRORS']['phoneerror'] = 'Mobile Number  is already taken';
        //     header("Location: ../");
        //     exit();
        // }
        if (!availableEmail($conn,$email)) {

            $_SESSION['ERRORS']['emailerror'] = 'Email already taken';
            header("Location: ../");
            exit();
        }
        /*
        * -------------------------------------------------------------------------------
        *   User Creation
        * -------------------------------------------------------------------------------
        */

        $sql = "INSERT into zha_users( zha_fullname, zha_email,  zha_phone, zha_password, zha_created_at) 
                values ( ?,?,?,?, NOW() )";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {

            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        }
        else{
            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $phone, $hashedPwd);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);;
            /*
            * -------------------------------------------------------------------------------
            *   Sending Verification Email for Account Activation
            * -------------------------------------------------------------------------------
            */

            require 'sendverificationemail.inc.php';

             $_SESSION['zha_email'] = $email;
            header("Location: ../../registerwelcome");
            exit();
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
 {

    header("Location: ../");
    exit();
}