<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Success</title>

    <style>
        .border{
            position: relative;
            width: 700px;
            height: 560px;

            border: 5px solid #2997FF;
            box-sizing: border-box;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.25));
            border-radius: 33px;
        }
        td{
            padding: 10px;
            font-family: 'Lato', sans-serif;
            padding-right:10px;
            padding-left:40px;
            text-align: left;

        }
        .wt{
            font-family: 'Lato', sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 20px;
            align-items: center;
            text-align: center;
            color: #2997FF;
        }
        .pt{
            font-family: 'Lato', sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            align-items: center;
            text-align: center;
            color: #2997FF ;

        }
    </style>

</head>

<body>
    <div class="border">
        <table>
           <H6 class="wt"> AZHAGA</H6>
           <p class="pt"> Customer question </p>
            <tr>
                <td>Name</td>
                <td>{{ username }}</td>
                
            </tr>

            <tr>
                <td>Email</td>
                <td>{{ email }}</td>
                
            </tr>

            <tr>
                <td>Message</td>
                <td>{{ message }}</td>
                
            </tr>

        </table>
    </div>
</body>