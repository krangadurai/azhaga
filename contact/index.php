<?php 

define('TITLE','Contact Us');
include '../assets/layouts/header.php';

?>

<maim role="main" class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>

        <div class="col-sm-6 px-5">

            <form class="form-auth" action="includes/contact.inc.php" method="post">

                <?php insert_csrf_token(); ?>

                <h6 class="h3 mb-3 font-weight-normal text-muted text-center tt"> Contact</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if(isset($_SESSION['STATUS']['success']))
                                   echo $_SESSION['STATUS']['success'];
                         ?>
                         <?php $_SESSION['STATUS']['success']= '';?>
                    </small>
                    <small class="text-danger font-weight-bold">
                        <?php
                            if(isset($_SESSION['STATUS']['error']))
                                   echo $_SESSION['STATUS']['error'];
                         ?>
                          <?php $_SESSION['STATUS']['error']= '';?>
                    </small>
                </div>
                
                <?php if(!isset($_SESSION['auth'])){ ?>
                
                <div class="form-group m-3">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" id="name" name="name" class='form-control' placeholder="Name" required autofocus>
                </div>
                
                <div class="form-group m-3">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class='form-control' placeholder="Email" required>
                </div>
            
                <?php } ?>

                <div class="from-group m-3">
                    <label for="message" class="sr-only">Message</label>
                    <textarea  id="message" name='message' placeholder="Your Messages...." class="form-control ht" rows="6"></textarea>
                </div>

                <div class="text-center m-3 px-5">
                    <button class="btn btn-lg btn-primary btn-send" type="submit" name="contact-submit" value="contact-submit">Send</button>
                </div>

            </form>
        
        </div>

        <div class="col-sm-3">

        </div>
    </div>
</maim>

<?php

include "../assets/layouts/footer.php";
?>