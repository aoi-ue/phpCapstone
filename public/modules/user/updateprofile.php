<?php
session_start();
require_once '../../includes/autoload.php';
require_once '../../includes/password.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);
?>

<?php
$success="";
$formerror="";
$firstName="";
$lastName="";
$email="";
$companyName="";
$city="";
$country="";
$password="";

$error_fname="";
$error_lname="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$validate1=new Validation();
$validate2=new Validation();
$validate3=new Validation();
$validate4=new Validation();



if(!isset($_POST["submitted"])){
	
	$validate->check_password($password, $error_passwd);
	$validate1->check_fname($firstName, $error_fname);
	$validate2->check_lname($lastName, $error_lname);
	$validate3->check_email($email, $error_email);
	$validate4->check_lname($companyName, $error_lname);

	
	
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_SESSION["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
 $companyName=$existuser->companyName;
 $city=$existuser->city;
 $country=$existuser->country;
  $password=$_SESSION["password"]; 
}else{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $email=$_POST["email"];
 $companyName=$_POST["companyName"];
 $city=$_POST["city"];
 $country=$_POST["country"];
  $password=$_POST["password"];

  if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
       $update=true;
       $UM=new UserManager();
       if($email!=$_SESSION["email"]){
           $existuser=$UM->getUserByEmail($email);
           if(is_null($existuser)==false){
               $formerror="User Email already in use, unable to update email";
               $update=false;
           }
       }
       if($update){
           $existuser=$UM->getUserByEmail($_SESSION["email"]);
           $existuser->firstName=$firstName;
           $existuser->lastName=$lastName;
           $existuser->email=$email;
		 $existuser->companyName=$companyName;
		 $existuser->city=$city;
		 $existuser->country=$country;
		 $hash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
		 $existuser->password=$hash;	
         //  $existuser->password=$password;
           $UM->saveUser($existuser);
           $_SESSION["email"]=$email;
		   $success="Updated Successfully!";
		   
          // header("Location:../../home.php");
       }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<script type= "text/javascript" src = "countries.js"></script>
<h1 style="margin-top: 60px; text-align:center;">Update Profile</h1>

<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 25%;>
<style>
.success {color:green; font-weight: bold; font-size: 20px;}
</style>
<body>
<div><?=$formerror?></div><span class="success"><?=$success?></span>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>
     <tr>    
    <td>Company Name</td>
    <td><input type="text" name="companyName" value="<?=$companyName?>" size="20"></td>
	<span class="error"><?php echo $error_lname?></span>
  </tr>  
      <tr>    
    <td>Country</td>
	<td><?=$country?></td>
<tr><td></td><td><select id="country" name ="country"></select></td></tr>
  </tr>  
    <tr>    
    <td>City</td>
	<td><?=$city?></td>
	<tr><td></td><td><select name ="city" id ="city"></select></td></tr>
  </tr>  

  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" size="20"></td>
  </tr>
  <br>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$password?>" size="20"></td>
  </tr>
	<tr>
    <td></td>   
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary"></td>   
  </tr>
</table>
</form>
</body>
<script language="javascript">
	populateCountries("country", "city"); // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>


<?php
include '../../includes/footer.php';
?>