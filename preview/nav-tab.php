<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-buy-details-tab" data-toggle="tab" href="#nav-buy-details" role="tab" aria-controls="nav-buy-details" aria-selected="true">Buy Details</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Description</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Review</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active" id="nav-buy-details" role="tabpanel" aria-labelledby="nav-buy-details-tab">
        <div class="border">  

            <div class="container text-center">
                <h3 class="pt  text-center"><?php echo  $row['zha_product_name']; ?></h3>
            </div>

            <div class="contaiener">

                <Table class="table">
                    <tr>
                        <th> Price</th>
                         <th><?php echo  $row['zha_price']; ?> <span>&#8377;</span> </th>
                    </tr>
                    

                    <tr>
                        <th>quantity</th>
                        <th>
                            <form action="../orderconfirm/index.php" method="post">
                                <input type="hidden" name="" value="<?php echo  $row['zha_price']; ?>" id="price">
                                <input type="number"  class="qtyin" name="quantity" oninput="calc()" value="1" min="1" maxlength="1" max="3"  id="quantity">
                           
                        </th>
                    </tr>


                        

                    <tr>
                        <th >Total Amount</th>
                        <th id="total-price" ><?php echo  $row['zha_price']; ?> <span>&#8377;</span></th>
                    </tr>
                    <script>
                        function calc(){
                            var a= document.getElementById('price').value;
                            var b = document.getElementById('quantity').value ;
                            var c= a*b;

                            document.getElementById("total-price").innerHTML = c+"<span>&#8377;</span>";
                        }
            
                    </script>
                </Table>
                
            </div>

        </div>
    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        <div class="border">  
                     <?php echo  $row['zha_product_description']; ?>
        </div>
        
    </div>

    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="border">
                  ...
        </div>
    </div>
</div>