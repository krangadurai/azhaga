<?php

function _cleaninjections($test){

    $find=array(
        "/[\r\n]/",
        "/%0[A-B]/",
        "/%0[a-b]/",
        "/bcc\:/i",
        "/content\-Type\:/i",
        "/Mime\-version\:/i",
        "/cc\:/i",
        "/from\:/i",
        "/to\:/i",
        "/Content\-Tranfer\-Encoding\:/i"
    );
    $ret=preg_replace($find,'',$test);
    return $ret;
}

function generate_csrf_token(){

    if(!isset($_SESSION)) {

        session_start();
    }

    if(empty($_SESSION['token'])) {

        $_SESSION['token']=bin2hex(random_bytes(32));
    }
}

function insert_csrf_token(){

    generate_csrf_token();

    echo'<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
}
function verify_csrf_token(){

    generate_csrf_token();

    if (!empty($_POST['token'])) {

        if (hash_equals($_SESSION['token'],$_POST['token'])) {

            return true;
        }
        else{

            return false;
        }
    }
    
     else{
        
        return false;
    }
    
}