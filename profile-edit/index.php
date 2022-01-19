<?php
session_start();
include '../assets/layouts/header.php';
checked_logged_in();
check_verified();

?>

<div class="container rounded bg-white mt-5">
    <div class="row">
            <!-- ------------------- profile edit-------------------------- -->
        <div class="col-md-4 border-right">
            <div class="p-3 py-5" >
                <form action="includes/pfedit.inc.php" method="post">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h6 class="text-right font-weight-bold et">Edit Profile</h6>
                    </div>
                    <div class="row mt-2">

                    <?php insert_csrf_token(); ?>
                
                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="text" name="fullname" class="form-control" placeholder="<?php echo $_SESSION['zha_fullname']; ?>">
                        </div>
                        <div class="col-md-12 mt-2 p-1 ">
                           
                            <input type="tel" name='phone' class="form-control" placeholder="<?php echo $_SESSION['zha_phone']; ?>" >
                        </div>
                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="email" name="email" class="form-control" placeholder="<?php echo $_SESSION['zha_email']; ?>" disabled>
                        </div>
                        
                    </div>

                    <div class="mt-3 text-right">
                        <button name="pfedit" class="btn-profile" type="submit">Save </button>
                    </div>
                </form>
            </div>
            
        </div>
    <!-- -------------------addrees change-------------------------- -->
        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <form action="includes/pfedit.inc.php" method="post">
              
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h6 class="text-right font-weight-bold et">Address change</h6>
                    </div>
                    <div class="row mt-2">

                         <?php insert_csrf_token(); ?>
                
                        <div class="col-md-12 mt-2 p-1 ">

                            
                            <textarea name="address"class="form-control" id="" cols="3" placeholder="<?php if (isset(  $_SESSION['zha_address'])){ echo $_SESSION['zha_address'];}else{ echo "Address"; } ?>" rows="2"></textarea>
                            <small id="helpId" class="text-danger">

                                <?php
                                    if (isset(  $_SESSION['ERROR']['zha_address'])){
                                        echo   $_SESSION['ERROR']['zha_address'];
                                    }
                                    $_SESSION['ERROR']['zha_address']    = '';

                                ?>
                            </small>
                            
                        </div>

                        <div class="col-md-12 mt-2 p-1 ">
                           
                            <input type="text" name="city" class="form-control" placeholder="<?php if (isset(  $_SESSION['zha_city'])){ echo $_SESSION['zha_city'];}else{ echo "City"; } ?>" >
                            <small id="helpId" class="text-danger">

                                <?php
                                    if (isset(  $_SESSION['ERROR']['zha_city'])){
                                        echo   $_SESSION['ERROR']['zha_city'];
                                    }
                                    $_SESSION['ERROR']['zha_city']       = '';
                                    
                                ?>
                            </small>
                        </div>

                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="text" name="state" class="form-control" placeholder="<?php if (isset(  $_SESSION['zha_state'])){ echo $_SESSION['zha_state'];}else{ echo "State"; } ?>">
                            <small id="helpId" class="text-danger">
                                <?php
                                    if (isset(  $_SESSION['ERROR']['zha_state'])){
                                        echo   $_SESSION['ERROR']['zha_state'];
                                    }
                                    
                                    $_SESSION['ERROR']['zha_state']      = '';
                                    
                                ?>
                            </small>
                        </div>

                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="text" name="country" class="form-control" placeholder=" <?php if (isset(  $_SESSION['zha_country'])){ echo $_SESSION['zha_country'];}else{ echo "Country"; } ?>" >
                            <small id="helpId" class="text-danger">

                                    <?php
                                        if (isset(  $_SESSION['ERROR']['zha_country'])){
                                            echo   $_SESSION['ERROR']['zha_country'];
                                        }
                                        $_SESSION['ERROR']['zha_country']    = '';
                                    ?>
                            </small>
                        </div>
                        
                        <div class="col-md-12 mt-2 p-1  ">
                            
                            <input type="text" name="postalcode" class="form-control" placeholder=" <?php if (isset(  $_SESSION['zha_postalcode'])){ echo $_SESSION['zha_postalcode'];}else{ echo "Postal code"; } ?>" >
                            <small id="helpId" class="text-danger">

                                <?php
                                    if (isset(  $_SESSION['ERROR']['zha_postalcode'])){
                                        echo   $_SESSION['ERROR']['zha_postalcode'];
                                    }
                                    $_SESSION['ERROR']['zha_postalcode'] = '';
                                ?>
                            </small>
                        </div>
                        
                    </div>

                    <div class="mt-3 text-right">
                        <button name="adedit" class="btn-profile" type="submit">Save </button>
                    </div>
                </form>
            </div>
            
        </div>
            <!-- -------------------password change-------------------------- -->

        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <form action="includes/pfedit.inc.php" method="post">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h6 class="text-right font-weight-bold et">Password Change</h6>
                    </div>
                    <div class="row mt-2">
                         <?php insert_csrf_token(); ?>
                
                        <div class="col-md-12 mt-2 p-1 ">
                           
                            <input type="text" name="oldpassword" class="form-control" placeholder="Old Password">
                        </div>
                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="text" name='newpassword' class="form-control" placeholder="New Password" >
                        </div>
                        <div class="col-md-12 mt-2 p-1 ">
                            
                            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" >
                        </div>
                    
                        
                    </div>

                    <div class="mt-3 text-right">
                        <button name="pdedit" class="btn-profile" type="submit">Save </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<?php

include "../assets/layouts/footer.php";
?>