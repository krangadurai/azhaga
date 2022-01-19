<?php

function availablePhone($conn,$phone){

    $sql='SELECT zha_user_id from zha_users where az_cm_phone=?;';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){

        return $_SESSION['ERRORS']['scripterror']='SQL error';
    }
    else{

        mysqli_stmt_bind_param($stmt,"s",$phone);
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

function availableEmail($conn,$email){

    $sql='SELECT zha_user_id from zha_users where zha_email=?;';
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){

        return $_SESSION['ERROR']['scripterror']='SQL error';
    }
    else{

        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck=mysqli_stmt_num_rows($stmt);
         
         if($resultCheck > 0 ) {
             
            return false;
         }else{

             return true;
         }
    }
}