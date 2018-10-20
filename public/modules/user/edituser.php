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

$formerror="";
$firstName="";
$lastName="";
$companyName="";
$city="";
$country="";
$email="";
$password="";
$role="";
$id="";

	if(isset($_GET["id"]))
	{
	  $UM=new UserManager();
	  $existuser=$UM->getUserById($_GET["id"]);
	  $firstName=$existuser->firstName;
	  $lastName=$existuser->lastName;
	  $email=$existuser->email;
	  $role=$existuser->role;
	  //print_r($existuser);
	  //$password=$existuser->password;
	}
	
	

	if(isset($_POST["submitted"])){   
	echo $_POST['role'];
	$id = $_GET["id"];
	$role=$_POST['role'];
	 $UM=new UserManager();
    $existuser=$UM->updateuser($id,$role);
		   //$existuser->role=$role;
           //$UM->saveUser($existuser);
          header("Location:../../modules/user/userlist.php");
  }else{
      $formerror="Please provide required values";
	  
  }
	

?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<h1 style="margin-top: 60px; text-align:center;">Edit User</h1>
<form name="deleteUser" method="post" class="pure-form pure-form-stacked" style="margin-left: 37%;">
<table width="800">
  <tr>
    <td>First Name</td>
    <td><?=$firstName?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><?=$lastName?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?=$email?></td>
  </tr>
  <tr>
 <!-- <td>Role</td>
    <td><input type="text" name="role" value="<?=$role?>" size="10"></td>-->
	<td>Role</td>
	<td><select name="role">
	<option value="">Select...</option>
	<option value="admin">Admin</option>
	<option value="user">User</option>
	</select></td>

  </tr>
  <tr>
    <td><a class="pure-button" href="userlist.php">Back</a></td>
    <td><input type="submit" name="submitted" value="Edit" class="pure-button pure-button-primary"></td>
  </tr>
</table>

</form>


<?php
include '../../includes/footer.php';
?>