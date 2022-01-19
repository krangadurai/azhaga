<?php
session_start();
require '../../../assets/setup/env.php';
require '../../../assets/setup/db.inc.php';
require '../../../assets/includes/security_functions.php';


if (isset($_POST['addproduct'])){
   
     /*
     * -------------------------------------------------------------------------------
     *   Securing against Header Injection
     * -------------------------------------------------------------------------------
     */

    foreach ($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }

   /*
   * -------------------------------------------------------------------------------
   *   Verifying CSRF token
   * -------------------------------------------------------------------------------
   */


    if(!verify_csrf_token()){
                       
       $_SESSION['STATUS']['signupstatus'] = 'Requst could not be validated';
       header('Location: ../');
       exit();
    }

  


    
    $id             = $_SESSION['admin']['zha_admin_id'];
    $name           = $_POST['productname'];
    $oneline        = $_POST['productoneline'];
    $description    = $_POST['productdescription'];
    $stockquantity  = $_POST['productstockquantity'];
    $category       = $_POST['productcategory'];
    $price          = $_POST['productprice'];
    $oldprice       = $_POST['productoldprice'];
    $color          = $_POST['productcolor'];
    $size           = $_POST['productsize'];
    $weight         = $_POST['productweight'];
    $thumb          = $_FILES['productthumb']['name'];
    $target         = "../../../assets/images/".basename($thumb);


    $sql = "INSERT INTO zha_products
    ( 
       zha_admin_id
      ,zha_product_name 
      ,zha_product_oneline 
      ,zha_product_description 
      ,zha_stock_quantity 
      ,zha_category_name 
      ,zha_price 
      ,zha_old_price 
      ,zha_color 	
      ,zha_size 	
      ,zha_product_thumb 	
      ,zha_product_weight 
    ) 
    VALUES
    (
        '$id',
        '$name',    
        '$oneline',      
        '$description',  
        '$stockquantity',
        '$category',     
        '$price',        
        '$oldprice',     
        '$color',        
        '$size',           
        '$thumb',
        '$weight'    
    );";
    mysqli_query($conn, $sql);
    echo mysqli_error($conn);

    if (move_uploaded_file($_FILES['productthumb']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    

}

