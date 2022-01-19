<?php
define('TITLE','Signup');
include '../assets/layouts/header.php';
check_logout();
?>



<div class="container">
    <div class="row">
        <div class="col-xl-4  col-lg-6 col-md-12"></div>
        <div class="col-xl-4  col-lg-6 col-md-12">

            <form action="includes/register.inc.php" method="POST"  onsubmit="return checkCheckBoxes(this);" enctype="multipart/form-data">
                
                <?php insert_csrf_token(); ?>
                
                 <div class="text-center">
                     <sub class="text-danger">

                        <?php                          
                         if (isset($_SESSION['ERRORS']['formerror']))
                            echo $_SESSION['ERRORS']['formerror'];

                         if(isset($_SESSION['ERRORS']['sqlerror']))
                            echo $_SESSION['ERRORS']['sqlerror'];
                         ?>
                         <?php   $_SESSION['ERRORS']['sqlerror']      = ''; 
                                 $_SESSION ['ERRORS']['formerror']    = '';
                         ?>
                     </sub>
                 </div>

                 <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center tt">Create Account</h6>

                 <div class="text-center mb-3">
                     <small class="text-success font-weight-bold">
                         <?php

                            if (isset($_SESSION['STATUS']['signupstatus']))
                                echo $_SESSION['STATUS']['signupstatus'];
                         ?>
                     </small>
                 </div>

                 <div class="form-group">

                    <label for="Name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" require autofocus>
                 </div>

                 <div class="form-group">
                     <label for="email" class="sr-only">Email address</label>
                     <input type="email" class="form-control" placeholder="Email" name="email" id="email" require autofocus>
                     <sub class="text-danger">
                         <?php
                             if (isset($_SESSION['ERRORS']['emailerror']))
                                echo $_SESSION['ERRORS']['emailerror'];
                            
                         ?>
                         <?php   $_SESSION['ERRORS']['emailerror'] =''; ?>
                     </sub>
                 </div>

                 <div class="form-group">

                    <label for="phone" class="sr-only">Mobile</label>

                     <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">+91</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Moblie Number" pattern="[0-9]{10}" require autofocus>
                    </div>
                    <sub class="text-danger">
                         <?php
                             if (isset($_SESSION['ERRORS']['phoneerror']))
                                echo $_SESSION['ERRORS']['phoneerror'];
                         ?>
                         <?php
                                $_SESSION['ERRORS']['phoneerror'] ='';
                         ?>
                    </sub>
                </div>

                <div class="form-group">
                     <label for="password" class="sr-only">Password</label>

                     <input type="text" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                     placeholder="Password"  class="form-control" >

                </div>

                <div class="form-group">
                     <label for="confirm_password" class="sr-only">Confirm Password</label>
                     
                     <input type="password" name="confirm_password" id="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                     placeholder="Confrim Password"  class="form-control" >

                     <sub class="text-danger">
                         <?php
                             if (isset($_SESSION['ERRORS']['passworderror']))
                                echo $_SESSION['ERRORS']['passworderror'];
                         ?>
                         
                     </sub>
                </div>


                <div class="col-auto my-1 mb-4">
                    <div class="custom-control custom-checkbox  mr-sm-5">
                        <input type="checkbox" class="custom-control-input" id="terms" name="terms">
                        <label class="custom-control-label" for="terms">I unsterstand and agree to  &nbsp; <a href="../privacypolicy">Privacy Policy</a> &nbsp; and &nbsp; <a href="../terms&condition">Terms &  Conditions</a></label>
                    </div>
                </div>

                <div class="container text-center">
                    <input type="submit" name="signupsubmit" class="btn" value="Sign Up">
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function checkCheckBoxes(theForm) {
	if (theForm.terms.checked == false) 
	{
		alert ('Add "I Agree to Privacy Policy and Terms &  Conditions"');
		return false;
	} else { 	
		return true;
	}
}
</script>