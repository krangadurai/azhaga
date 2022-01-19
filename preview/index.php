<?php

define('TITLE', 'PalaniPanchamirtam');
include '../assets/layouts/header.php';

if (isset($_GET['id'])) {

    $pid= $_GET['id'];
    $sql  = 'SELECT * FROM zha_products WHERE  zha_product_id=?;';
    $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = mysqli_stmt_error($stmt);
            header("Location: ../home");
            exit();
        } 
        else {

            mysqli_stmt_bind_param($stmt,"s",$pid);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

            }
        }
}
?>

<div class="container">
        
    <div class="row">
        
        <div class="col-xl-6  col-lg-6 ">
          
            <div class="container text-center ">
                <img class="product-thumb" src="../assets/images/<?php echo  $row['zha_product_thumb']; ?>" alt="" srcset="">
            </div>

            <div class="container d-flex  text-center">
                

                <?php include 'popup.php' ?>
            </div>

        </div>

        <div class="col-xl-6  col-lg-6 ">
            <?php include 'nav-tab.php';?>
        </div>

    

        <div class="container mt-3 px-5 text-center">
        
            
                <input type="hidden" name="id" value="<?php echo $row['zha_product_id'];?>">
                <input type="submit" class="btn-buy btn-block" name="buy" value="BUY">

            </form>
            
        </div>

    </div>

</div>


    <?php

    include '../assets/layouts/footer.php';
    ?>
