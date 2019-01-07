<?php
$admin_cookie_code="1234567890";
setcookie("JoomlaAdminSession",$admin_cookie_code,0,"/");
header("Location: ../administrator/index.php");
?>
