<?php
define('TITLE','Signup');
include '../assets/layouts/header.php';
check_logout();
?>
<div class="container">
    <div class="row">
        <div class="col-xl-4  col-lg-6 col-md-12"></div>
        <div class="col-xl-4  col-lg-6 col-md-12 m-2">
              
            <form action="includes/login.inc.php" method="post">
            
               <?php insert_csrf_token(); ?>
              <div class="form-group">
                <label for=""></label>
                <input type="text"name='username' placeholder="Email or Phone" class=' form-control'>
                <small id="helpId" class="text-danger">
                  <?php
                      if(isset($_SESSION['STATUS']['error'])){
                        echo $_SESSION['STATUS']['error'];
                      }
                  ?>
                </small>
              </div>

              <div class="form-group">
                <label for=""></label>
                <input type="password"name='password' placeholder="Password" class=' form-control'>
                <small id="helpId" class="text-danger">
                <?php
                      if(isset($_SESSION['STATUS']['error'])){
                        echo $_SESSION['STATUS']['error'];
                      }
                      elseif(isset($_SESSION['ERRORS']['wrongpassword'])){
                        echo   $_SESSION['ERRORS']['wrongpassword'];
                      }
                  ?>
                </small>
              </div>
              <div class="container text-center mt-5">
                <button type="submit" name="login" class="btn-signup">
                    Login
                </button>
               </div>
            </form>
              <div class="container  mt-4 text-center">
                <a class="link ml-2" href="../reset-password">Forget Password</a>
              </div>
        </div>
    </div>
</div>