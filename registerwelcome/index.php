<?php

define('TITLE','registerwelcome');
require '../assets/layouts/header.php';



?>

<div class="container">  
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">

            <div class="sucess mt-3 p-3">

                <h4 class=" text-center wt">WELCOME AZAHGA</h4>
                <h5 class="wpt">DEAR CUSTOMER  REGISTRAION SUCESSFULL  </h5>
                <h5 class="wpt"> verification link has been sent your email account</h5>
                <h5 class="wpt"> <?php echo $_SESSION['zha_email'];?></h5>
                
                <h5 class="wpt">  THANK YOU!</h5>

            </div>

        </div>
    </div>
</div>
<?php header( "refresh:3;url= ../login" ); ?>
