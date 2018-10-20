<?php
/**
*this is homepage for first time user
 */
session_start();
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
require_once 'includes/password.php';
include 'includes/header.php';
$formerror="";

$role="";
$email="";
$password="";
$error_auth="";
//$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();

if(isset($_POST["submitted"])){
    $email=$_POST["email"];
    $password=$_POST["password"];

	$validate->check_password($password, $error_passwd);
	$validate1->check_email($email, $error_email);


	//if($validate->check_password($password, $error_passwd))
		if($error_passwd == "" && $error_email == "" ) {
		$UM=new UserManager();

		$existuser=$UM->getUserByEmail($email);
			if(isset($existuser)){

				$hashpass= $existuser->password;

				if (password_verify($password, $hashpass)) {


					$_SESSION['email']=$email;
					$_SESSION['id']=$existuser->id;
					$_SESSION['role']=$existuser->role;
					$_SESSION['password']=$password;
					echo '<meta http-equiv="Refresh" content="1; url=home.php">';


				} else {
				$formerror="Invalid User Name or Password";
				}
			}
			else{
				$formerror="Invalid User Name or Password";
			}
		}
}
?>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<style>
.error{color:red;}
}
</style>

<h1 style="margin-top: 60px; text-align:center;">Login</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 40%;>
<table border='0' width="100%" style=";">
  <tr>
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}" required title="Cannot be empty field" size="30">
	<span class="error"><?php echo $error_email?></span></td>
	<td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum" size="30">
	<span class="error"><?php echo $error_passwd?></span></td>
  </tr>
  <tr>
    <td><br></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary"></td>
     <td><input type="reset" name="reset" value="Cancel" class="pure-button pure-button-primary"></td>
  </tr>
  <tr>
  <td></td>
    <td>
	<div class="error"><?=$formerror?></div>
       <br><a class="pure-button" href="modules/user/register.php">Register Now</a>
	   <a class="pure-button" href="./forgetpassword.php">Forget Password</a>
    </td>
  </tr>
</table>
</form>


<?php
include 'includes/footer.php';
?>
