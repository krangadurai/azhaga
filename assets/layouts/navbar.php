
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-2">
    <div class="container">
        <a class="navbar-brand" href="../home">
            <img class="logo" src="../assets/images/logo1.png" alt="" srcset="">
        </a>

     <ul class="head">

        <?php if (!isset($_SESSION['auth'])) { ?>
                
                <li>
                    <a  href="../login">Login</a>
                </li>

                <li>
                    <a  href="../register">Signup</a>
                </li>

        <?php } else { ?>
            <li>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="imgdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <?php echo $_SESSION['zha_fullname']; ?>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="imgdropdown">
                       
                        <a class="dropdown-item " href="../profile-edit"><i class="fa fa-pencil-alt pr-2"></i>Edit Profile</a>
                        <a class="dropdown-item " href="../orders"><i class="fa fa-shopping-bag pr-2" ></i>Orders</a>
                        <a class="dropdown-item text-danger" href="../logout"><i class="fa fa-running pr-2"></i>Logout</a>
                        
                    </div>
                </div>
            </li>
        <?php } ?>

            
     </ul>
        
    </div>
</nav>