<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <style>
        .border{
            position: relative;
            width: 577px;
            height: 403px;
            left: 759px;
            top: 637px;

            border: 5px solid #2997FF;
            box-sizing: border-box;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.25));
            border-radius: 33px;
        }
        tt{
            position: absolute;
            width: 415px;
            height: 52px;
            left: 150px;
            top: 685px;

            font-family: 'Lato', sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 30px;
            line-height: 38px;
            align-items: center;
            text-align: center;
            color: #2997FF ;
        }
        td{
            text-align: center;
            color: #2997FF ;
            padding:0.7rem;
        }
    </style>
</head>
<body>
    <div class="border">
        <table>
            <tr>
                <td><h1 class="tt">{{ APP_NAME }}</h1></td>
            </tr>
            <tr>
                <td>
                    <h1>
                        Verify Your email
                    </h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Please confirm that you want you use this sellfy  account email address.</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <a  href=" {{ url }} " > {{ url }}</a>
                </td>
            </tr>
        

        </table>
    </div>
    
</body>
</html>