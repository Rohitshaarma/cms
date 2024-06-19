<?php
require_once("includes/db.php");
require_once("includes/function.php");
require_once("includes/session.php");
?>
<?php
 $_SESSION['User_ID'] = null;
 $_SESSION['Username'] = null;
 $_SESSION['AdmiNname'] = null;

session_destroy();
Redirect_to("login.php");

?>