<?php

session_start();

require '../../assets/includes/auth_functions.php';
require '../../assets/includes/datacheck.php';
require '../../assets/includes/security_functions.php';
require '../../assets/setup/db.inc.php';

function availableuser($conn,$phone){

    $sql="SELECT * from zha_users where zha_phone=? or   zha_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){

       $_SESSION['ERRORS']['scripterror']=mysqli_stmt_error($stmt);
    }
    else{

        mysqli_stmt_bind_param($stmt,"ss",$phone,$phone);
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


if (isset($_POST['login'])) {

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

        $_SESSION['STATUS']['loginstatus'] = 'Request could not be validated';
        header("Location: ../");
        exit();
    }



    
   

    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($username) || empty($password)) {

        $_SESSION['STATUS']['error'] = 'Fields cannot be empty';
        header("Location: ../");
        exit();
    }
    elseif(availableuser($conn,$username)){

        echo $_SESSION['STATUS']['error'] = 'Does Not find  account';
        header("Location: ../");
        exit();
    }
    else{

         /*
        * -------------------------------------------------------------------------------
        *   Updating last_login_at
        * -------------------------------------------------------------------------------
        */

        $sql = "UPDATE zha_users SET zha_last_login=NOW() WHERE zha_phone =? OR zha_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['STATUS']['error'] = mysqli_stmt_error($stmt);
            header("Location: ../");
            exit();
        }
        else {
            
            mysqli_stmt_bind_param($stmt,"ss",$username,$username);
            mysqli_stmt_execute($stmt);
        }   
        



        /*
        * -------------------------------------------------------------------------------
        *   Creating SESSION Variables
        * -------------------------------------------------------------------------------
        */
        $sql  = 'SELECT * FROM zha_users WHERE zha_phone =? OR zha_email=?;';
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['STATUS']['error'] = mysqli_stmt_error($stmt);
            header("Location: ../");
            exit();
        } 
        else {

            mysqli_stmt_bind_param($stmt,"ss",$username,$username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                $pwdCheck = password_verify($password,$row['zha_password']);

                if ($pwdCheck == false)  {

                    $_SESSION['ERRORS']['wrongpassword'] = 'Enter the correct Password';
                    header('Location: ../');
                    exit();
                }
                else if ($pwdCheck == true) {

                  


                    if ($row['zha_verified_at'] != NUll) {

                        $_SESSION['auth'] = 'verified';
                    } else{

                        $_SESSION['auth'] = 'loggedin';
                    }

                    $_SESSION['zha_user_id']       = $row['zha_user_id'];
                    $_SESSION['zha_fullname']      = $row['zha_fullname'];
                    $_SESSION['zha_email']         = $row['zha_email'];
                    $_SESSION['zha_phone']         = $row['zha_phone'];
                    $_SESSION['zha_verified_at']   = $row['zha_verified_at'];
                    $_SESSION['zha_created_at']    = $row['zha_created_at'];
                    $_SESSION['zha_update_at']     = $row['zha_update_at'];
                    $_SESSION['zha_last_login']    = $row['zha_last_login'];
                    /**
                     * ------------------------------------------------------------------------------
                     *    address information
                     * ------------------------------------------------------------------------------
                     */
                    
                    if ($_SESSION['auth'] == 'verified') {
                        
                        $sql    = 'SELECT * FROM zha_user_addresses WHERE zha_user_id=?;';
                        $stmt   = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)){

                            $_SESSION['ERRORS']['sqlerror'] = mysqli_stmt_error($stmt);
                            header("Location: ../");
                            exit();
                        }else{
                            
                            mysqli_stmt_bind_param($stmt,"s", $_SESSION['zha_user_id'] );
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                             
                            if (empty($row)){
                              
                                header("Location: ../../address");
                                exit();
                            }
                            else{
                                $_SESSION['zha_user_id'] = $row['zha_user_id'];
                                $_SESSION['zha_address'] = $row['zha_user_address'];
                                $_SESSION['zha_city']    = $row['zha_city'];
                                $_SESSION['zha_state']   = $row['zha_state'];
                                $_SESSION['zha_country'] = $row['zha_country'];
                                $_SESSION['zha_postalcode']= $row['zha_Postal_code'];
                            }

                        }
                    }


                    /*
                    * -------------------------------------------------------------------------------
                    *   Setting rememberme cookie
                    * -------------------------------------------------------------------------------
                    */

                    if (isset($_POST['rememberme'])) {

                        $selector = bin2hex(random_bytes(8));
                        $token    = random_bytes(32);

                        $sql  = "DELETE FROM zha_auth_tokens WHERE zha_email=? AND zha_auth_type='rememberme';";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                            header("Location: ../");
                            exit();
                        }
                        else {

                            mysqli_stmt_bind_param($stmt, "S", $_SESSION['zha_email']);
                            mysqli_stmt_execute($stmt);
                        }

                        setcookie(
                            'rememberme',
                            $selector.':'.bin2hex($token),
                            time() + 86400,
                            '/',
                            NULL,
                            false,
                            true
                        );

                        $sql= "INSERT INTO zha_auth_tokens (zha_email, zha_auth_type, zha_selector, zha_token,zha_expiry_at)
                               VALUES (?,'remember_me',?,?,?);";
                        
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt,$sql)) {

                            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                            header("Location: ../");
                            exit();
                        }
                        else {
                            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt,'ssss',$_SESSION['zha_email'],$selector, $hashedToken,date('Y-m-d\TH:i:s',time()+86400));
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    
                    if(isset($_SESSION['buy'])){
                        
                        header("Location: ../../orderconfirm");
                    }else {

                        header("Location: ../../home");
                    }
                }
                    
                }
            else {

                $_SESSION["ERRORS"]['nouser'] =  mysqli_stmt_error($stmt);
                header("Location: ../");
                exit();
            }
        }
    }
}

