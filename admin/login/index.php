<?php

require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';

?>
<form action="includes/adlogin.inc.php" method="post">

<H2> azhga admin Login</H2>
<div>
    <label for="email">email</label>
    <input type="email" name="email" id="">
</div>

<div>
    <label for="pass">password</label>
    <input type="password" name="pass" id="">
</div>
<input type="submit" value="Submit" name="ad_submit">
</form>                                                         