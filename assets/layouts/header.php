<?php
require '../assets/setup/env.php';
require '../assets/setup/db.inc.php';
require '../assets/includes/auth_functions.php';
require '../assets/includes/security_functions.php';

if (isset($_SESSION['auth']))
    $_SESSION['expire'] = ALLOWED_INACTIVITY_TIME;

generate_csrf_token();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="<?php echo APP_DESCRIPTION ?>">
    <meta name="author" content="<?php echo APP_OWNER   ?>">

    <title><?php echo TITLE . ' | ' . APP_NAME; ?></title>
    <link rel="icon" type="image/png" href="../assets/images/icon.png">
    
    <link rel="stylesheet" href="../assets/vendor/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome-5.12.0/css/all.min.css">

    <script src="../assets/vendor/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/vendor/js/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
 
    <!-- Custom styles -->
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="custom.css" >
    
</head>
<body>
    <?php include 'navbar.php'; ?>
</body>
</html>