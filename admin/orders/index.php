<?php
session_start();
require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';
 
 if (isset($_SESSION['admin']['zha_admin_id'])) {

    $sql  = "SELECT * FROM zha_orders";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt,$sql)){

      echo mysqli_stmt_error($stmt);
    }
    else {

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      
      echo'<table>
      <tr>
          <td>Product Name </td>
          <td>price</td>
          <td>qty</td>
          <td>total</td>
          <td>order id</td>
          <td>payment_id</td>
           <td>p status</td>
          <td>order time</td>
          <td>user name</td>
          <td>phone</td>
          <td>mail</td>
          <td>address</td>
          <td>d tatus</td>
      </tr>';
      while($row= mysqli_fetch_assoc($result) ){
         
        
            echo '<tr>
            <td>'.$row['zha_product_name'].'</td>
            <td>'.$row['zha_product_price'].'</td>
            <td>'.$row['zha_product_quantity'].'</td>
            <td>'.$row['zha_product_total_price'].'</td>
            <td>'.$row['zha_order_id'].'</td>
            <td>'.$row['zha_payment_id'].'</td>
            <td>'.$row['zha_status'].'</td>
            <td>'.$row['zha_order_time'].'</td>'
            ;
            

      }

   }
 }
?>