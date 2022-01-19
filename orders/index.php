<?php

include "../assets/layouts/header.php";
check_verified();

if  (isset($_SESSION['zha_user_id'])) {

    $sql  = "SELECT *  FROM zha_orders WHERE zha_user_id=? ORDER BY zha_order_time DESC;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)) {

        echo mysqli_stmt_error($stmt);
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['zha_user_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);  
?>    



<div class="container">
    <div class="row">

        <div class="container text-center">
            <h5 class="ht">YOUR ORDERS</h5>
        </div>

        <?php 
        
        if(mysqli_num_rows($result) == 0){?>
            <div class="col-lx-3 p-1 mb-2">
            
            <table class="table table-responsive" style="border:none">
                    <tbody>

                        <tr>
                            <th scope="row">Record Not Found..</th>
                            
                        </tr>
                    </tbody>
            </table>
        </div>
        <?php }else{
            while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-lx-3 p-1 mb-2">
            <div class="border" style="align-items: center !important;">

                <table class="table table-responsive" style="border:none">
                        <tbody>

                            <tr>
                                <th scope="row">Product Name</th>
                                <td><?Php echo $row['zha_product_name'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Product Quantity</th>
                                <td><?Php echo $row['zha_product_quantity'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Product price</th>
                                <td><?Php echo $row['zha_product_price'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Total Amount</th>
                                <td><?Php echo $row['zha_product_total_price'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Order ID</th>
                                <td><?Php echo $row['zha_order_id'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Payment ID</th>
                                <td><?Php echo $row['zha_payment_id'] ?></td>
                            </tr>


                            <tr>
                                <th scope="row">Payment Status</th>
                                <td><?Php echo $row['zha_status'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Order ID</th>
                                <td><?Php echo $row['zha_order_time'] ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Delivery Status</th>
                                <td></td>
                            </tr>
                        </tbody>
                </table>
            </div>
        
        </div>
        <?php }
    }?>

    </div>

    <?php 
      }

}
?>
</div>

<?php

include "../assets/layouts/footer.php";
?>