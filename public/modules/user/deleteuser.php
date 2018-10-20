<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
?>

<?php
$error="";
$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$deleteflag=false;

if(isset($_POST["submitted"])){
  if(isset($_GET["id"])){
	  
	  if($_GET["id"] !== $_SESSION["id"]){
	  
       $UM=new UserManager();
       $existuser=$UM->deleteAccount($_GET["id"]);
        $formerror="User deleted successfully.";
		$deleteflag=true;
	} else { $error="Unable to delete yourself";}
}//else if(isset($_POST["cancelled"])){
//	header("Location:../../home.php");
}else{
	if(isset($_GET["id"]))
	{
	  $UM=new UserManager();
	  $existuser=$UM->getUserById($_GET["id"]);
	  $firstName=$existuser->firstName;
	  $lastName=$existuser->lastName;
	  $email=$existuser->email;
	  $password=$existuser->password;
	}
}

?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="deleteUser" method="post" class="pure-form pure-form-stacked">
<h1>Delete User</h1>
<style>
.error{color: red;}
</style>
<div class="error"><?=$formerror?></div><div class="error"><?=$error?></div>
<?php
if (!$deleteflag)
{
?>
<table width="800">
  <tr>
    <td>Are you sure that you want to delete the following record?</td>
  </tr>
   <tr>
    <td><div class="error"><?=$email?></div></td>
  </tr>
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Delete" class="pure-button pure-button-primary">
    <a class="pure-button" href="userlist.php">Back</a></td>
    </td>
  </tr>
</table>
<?php
}
?>
</form>


<?php
include '../../includes/footer.php';
?>