<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Success</title>

    <style>
        .border{
            position: relative;
            width: 650px;
            height: 450px;

            border: 5px solid #2997FF;
            box-sizing: border-box;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.25));
            border-radius: 33px;
        }
        td{
            padding: 10px;
            font-family: 'Lato', sans-serif;
            padding-right:100px;
            padding-left:40px;
            text-align: left;

        }
    </style>

</head>

<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <div class="border">
            
             <h4 style=" text-align:center;font-family: 'Lato', sans-serif;font-style: normal;font-weight: normal;font-size: 30px;color: #2997FF;"> Azhaga </h4>
             <p style="text-align:center;  font-family: 'Lato', sans-serif;font-style: normal;font-weight: normal;font-size: 30px;line-height: 38px;align-items: center;text-align: center; color: #BF4800;">Your order Completely Success </p>
             <table>
                <tr>
                    <td>Product Name</td>
                    <td>{{ product_name }}</td>
                </tr>
                
                <tr>
                    <td>Product price</td>
                    <td>{{ product_price }} <span>&#8377;</span></td>
                </tr>

                <tr>
                    <td>Product Quantity</td>
                    <td>{{ product_quantity }}</td>
                </tr>
                <tr>
                    <td>Product Total</td>
                    <td>{{ product_total }} <span>&#8377;</span></td>
                </tr>

                <tr>
                    <td>Order Id</td>
                    <td>{{ product_order_id }}</td>
                </tr>
                <tr>
                    <td>Payment Id</td>
                    <td>{{ product_payment_id }}</td>
                </tr>
                <tr>
                    <td>Estimated Delivery</td>
                    <td>5 days to 7days</td>
                </tr>   
                
             </table>


    </div>
</body>
</html>