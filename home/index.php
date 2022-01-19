


<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';

?>
<?php
$sql  = 'SELECT * FROM zha_products ;';

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {

    $_SESSION['ERRORS']['scripterror'] = mysqli_stmt_error($stmt);
    echo mysqli_stmt_error($stmt);
    exit();
} 
else {

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
     ?>
<div class="container">

    <div class="row">

        <?php   while($row= mysqli_fetch_assoc($result) ){ ?>
        

               
               <div class="col-xl-4  col-lg-6 col-md-12   mt-4">
                   <div class="border">
                       <div class="container text-center  p-2">
                           <img class="product-thumb" src="../assets/images/<?php echo $row['zha_product_thumb'];?>" alt="">
                       </div>
                       <div class="text-center">
                           <h3><a class="product-title" href=""><?php echo $row['zha_product_name'];?></a></h3>
                       </div>
                       <div class="d-flex pa">
                           <Span class="product-price"> &#8377;<?php echo $row['zha_price'];?> </Span>

                           <form action="../preview/index.php" method="get">

                                <input type="hidden" name="id" value="<?php echo $row['zha_product_id'];?>">
                                <input type="submit" value="view" class="btn-view">
                            </form>

                       </div>
                   </div>
               </div>


        
        <?php    }
    
}
?>
    </div>

</div>
       
<?php

include "../assets/layouts/footer.php";
?>


