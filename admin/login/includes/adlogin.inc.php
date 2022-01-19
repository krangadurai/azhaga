<?php
require '../../../assets/setup/env.php';
require '../../../assets/setup/db.inc.php';
session_start();

if (isset($_POST['ad_submit'])) {

    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    $sql   = 'SELECT * FROM zha_admins WHERE zha_admin_email=?;';
    $stmt  = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo  'rtto';
    }else {
         
        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        
        function pass($pass,$row){
            if($pass != $row){
                return false;
            }
            else {
                return true;
            }
        }
  
        $passcheck= pass($pass, $row['zha_admin_password']);

        if ($passcheck != true){
           echo $_SESSION['admin']['error']= 'wrong passward';
        }else{
            $_SESSION ['admin']['zha_admin_email'] = $row['zha_admin_email'];
            $_SESSION['admin']['zha_admin_id']     = $row['zha_admin_id'];
            $_SESSION['admin']['zha_admin_name']   = $row['zha_admi_name'];
            
            header("Location: ../../home/");
        }
    }

}


