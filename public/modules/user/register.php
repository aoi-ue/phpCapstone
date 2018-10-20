<?php
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';
include '../../includes/header.php';
//require_once
use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;
session_regenerate_id(TRUE);
$formerror="";

$firstName="";
$lastName="";
$email="";
//$companyName="";
//$city="";
//$country="";
$password="";

//$error_auth="";
$error_fname="";
$error_lname="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();
$validate2=new Validation();
$validate3=new Validation();


if(isset($_REQUEST["submitted"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
//	$companyName=$_REQUEST["companyName"];
//	$city=$_REQUEST["city"];
//	$country=$_REQUEST["country"];
    $password=$_REQUEST["password"];




	$validate->check_password($password, $error_passwd);
	$validate1->check_fname($firstName, $error_fname);
	$validate2->check_lname($lastName, $error_lname);
	$validate3->check_email($email, $error_email);
	//$validate2->check_lname($companyname, $error_lname);
	//$validate2->check_lname($lastName, $error_lname);
	//$validate2->check_lname($lastName, $error_lname);






    if($error_fname == "" && $error_lname == "" && $error_passwd == "" && $error_email == "" ){
		//if($firstName!='' && $lastName!='' && $email!='' && $password!=''){

        $UM=new UserManager();
        $user=new User();
        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
    		$hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
    		$user->password=$hash;
            //$user->password;
            $user->role="user";
    	$existuser=$UM->getUserByEmail($email);	



        if(!isset($existuser)){
            // Save the Data to Database
            $UM->saveUser($user);
            #header("Location:registerthankyou.php");
			session_start();
			//Set session variables
			$_SESSION["firstName"]=$firstName;
			echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
        }
        else{
            $formerror="User Already Exist";
        }
    }else{
        $formerror="Please fill in all fields";
    }
}

?>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><!-- jQuery Library-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">

<style>
.error{color:red;}
#passstrength {
    color:red;
    font-family:verdana;
    font-size:10px;
    font-weight:bold;
}
</style>
<body>
<h1 style="margin-top: 60px; text-align:center;">Registration Form</h1>
<div class="error"><?=$formerror?></div>
<form name="myForm" onsubmit="return validateForm()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="pure-form pure-form-stacked" style="margin-left: 40%;>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" id="firstName" value="<?=$firstName?>" size="30" required>
	<span class="error"><?php echo $error_fname?></span></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="30" required>
	<span class="error"><?php echo $error_lname?></span></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="30" required>
	<span class="error"><?php echo $error_email?></span></td>
  </tr>
  <!--  <tr>
    <td>Company Name</td>
    <td><input type="text" name="companyName" value="<?=$companyName?>" size="20">
	<span class="error"><?php echo $error_lname?></span><br>
  </tr>
    <tr>
    <td>City</td>
    <td><input type="text" name="city" value="<?=$city?>" size="20">
	<span class="error"><?php echo $error_lname?></span><br>
  </tr>
    <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="<?=$country?>" size="20">
	<span class="error"><?php echo $error_lname?></span><br>
  </tr>  -->

  <tr>
    <td>Password</td>
    <td><input type="password" name="password" id="password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum" size="20"></td>
	<td><span id="passstrength"></span></td>
	<span class="error"><?php echo $error_passwd?></span><br>
  </tr>
<br>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" id="confirm_password" value="<?=$password?>" pattern=".{6,}" required title="6 characters minimum" size="20"></td>
  </tr>
  <tr>
   <br> <td>
   <!--<div class="g-recaptcha" data-sitekey="6Lf2jD8UAAAAAEakJ1RObFa38MNspHCzvjsU1QcT"></div>-->
       <input type="submit" name="submitted" value="Submit">
       <input type="reset" name="reset" value="Cancel">
    </td>
  </tr>
</table>
</form>
</body>
<script type="text/javascript">
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

$('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});
</script>

<?php
include '../../includes/footer.php';
?>
