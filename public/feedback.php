<?php
use classes\entity\Feedback;
use classes\business\FeedbackManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
session_regenerate_id(TRUE);
$formerror="";

$email="";
$error_firstname="";
$error_lastname="";
$error_passwd="";
$error_email="";
$error_comments="";
$validate=new Validation();

	if(isset($_POST["submitted"])){
		$email=strip_tags($_POST["email"]);
		$lastname=strip_tags($_POST["lastname"]);
		$firstname=strip_tags($_POST["firstname"]);	
		$comments=strip_tags($_POST["comments"]);	
		
		$validate->check_fname($firstname, $error_firstname);
		$validate->check_lname($lastname, $error_lastname);
		if(empty($error_firstname) && empty($error_lastname) && empty($error_email) && empty($error_comments)){
			$feedback=new Feedback();
			$feedback->firstname=$firstname;
			$feedback->lastname=$lastname;
			$feedback->email=$email;
			$feedback->comments=$comments;
			$FM=new FeedbackManager();
			$FM->insertFeedback($feedback);
			$formerror="* Your feedback submitted successfully!";
		}
	}
?>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<h1 style="text-align: center;" >Feedback Form</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 35%;>
<br>

<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" size="50"></td>
	<td><?=$error_firstname?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" size="50"></td>
	<td><?=$error_lastname?></td>
  </tr>
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" size="50"></td>
  </tr>
  <tr>    
    <td>Comments</td>
	<td><textarea name="comments" rows = "7" cols = "50"></textarea></td>
    <td><?=$formerror?> </td>
  </tr>   
  <tr><td></td>
   <td><br> 
       <input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
       <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary">
    </td>
  </tr>
</table>
</form>