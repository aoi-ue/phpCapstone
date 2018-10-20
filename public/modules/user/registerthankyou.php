<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php'
?>
<?php
session_start();
//read from session
$firstName=$_SESSION["firstName"];
session_regenerate_id(TRUE);
?>

<h3><?php echo "Thank You ". $firstName?></h3>

You have successfully registered to community portal<br /><br />

Continue with <a href="../../login.php">login</a>


<?php
include '../../includes/footer.php';
?>