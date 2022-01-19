<?php
include '../assets/layouts/header.php';

 checked_logged_in();
 if (isset($_SESSION['zha_address'])){

     header("Location: ../home");
 }

?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>

        <div class="container ">
            <div class="container text-center">
                <h5>Shipping Address</h5>
            </div>
            <form class="form-auth" action="includes/address.inc.php" method="post">
            
                 <?php insert_csrf_token(); ?>

                <div class="container">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                    <label for="">Addrees</label>
                                    <textarea class="form-control" name="address" id="" rows="3"></textarea>

                                    <small id="helpId" class="text-danger" >

                                    <?php 
                                        if(isset( $_SESSION['ERROR']['zha_address'])){
                                            echo  $_SESSION['ERROR']['zha_address'];
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="">City</label>
                              <input type="text" name="city" id="" class="form-control" placeholder="" aria-describedby="helpId">

                                <small id="helpId" class=" text-danger" >

                                    <?php 
                                        if(isset( $_SESSION['ERROR']['zha_city'])){
                                            echo  $_SESSION['ERROR']['zha_city'];
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="">Postal code</label>
                              <input type="text" name="postalcode" id="" class="form-control" placeholder="" aria-describedby="helpId">

                                <small id="helpId" class="text-danger">

                                    <?php 
                                        if(isset( $_SESSION['ERROR']['zha_postalcode'])){
                                            echo  $_SESSION['ERROR']['zha_postalcode'];
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="">State</label>
                              <input type="text" name="state" id="" class="form-control" placeholder="" aria-describedby="helpId">

                                <small id="helpId" class="text-danger" style="color: red;">

                                    <?php 
                                        if(isset( $_SESSION['ERROR']['zha_state'])){
                                            echo  $_SESSION['ERROR']['zha_state'];
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="">Country</label>
                              <input type="text" name="country" id="" class="form-control" placeholder="" aria-describedby="helpId">

                                <small id="helpId" class="text-danger" style="color: red;">

                                    <?php 
                                        if(isset( $_SESSION['ERROR']['zha_country'])){
                                            echo  $_SESSION['ERROR']['zha_country'];
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 text-center">
                        <button type="submit" name="addaddress" class="btn btn-block">Save</button>
                        </div>

                    </div>

                </div>
                
            </form>
        </div>
    </div>
</div>


<?php

include "../assets/layouts/footer.php";
?>