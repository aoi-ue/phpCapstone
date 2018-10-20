<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\MessageManager;
use classes\entity\Message;
use classes\business\Validation;


ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);


?>

<?php
$success="";
$formerror="";
$error_fname="";
$error_lname="";
$userid="";
$company_name="";
$country="";
$details="";
$userid="";
//$posted_on="";
//$position_title="";
//$description="";
$to_id="";
$from_id="";
$firstName="";
$topic="";
$content="";
$firstName="";
$validate=new Validation();
$validate1=new Validation();


		if(isset($_POST["Form_Submit"])){

		$topic=strip_tags($_POST["topic"]);
		$content=strip_tags($_POST["content"]);


		//$validate->check_fname($subject, $error_fname);
		//$validate1->check_lname($content, $error_lname);


		if($error_fname == "" && $error_lname == ""){

//			foreach($_POST['to_id'] as $to_id){
				if($_SESSION["id"] !== $to_id){
					$message=new Message();
					$message->from_id=$_SESSION["id"];
					$message->to_id=$to_id;
					$message->topic=$topic;
					$message->content=$content;
					date_default_timezone_set('Singapore');
					$timestamp = date("Y-m-d H:i:s");
					$message->time_sent=$timestamp;
					$MM=new MessageManager();
					$MM->insertMessage($message);
					//print_r($message);

					$success="Message Successfully Sent!";
				// header("Location:../../modules/user/jobopp.php");
			}else{
			  $formerror="You can't send a message to yourself";

			 }
//			}


		}
		}

		?>

<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<style>
    .error{color:red;}
    }
</style>

<h1 style="margin-top: 60px; text-align:center;">Send Message</h1>

<html>
<head></head>
<body>
<div align = "center">
    <table>
        <tr>
        <form id="Form" method="post">
            <p>Enter Name: <input type="text" name="to_id" /></p>
            <p>Topic: <input type="text" name="topic" /></p>
            <p>Comment: <input type="text" name="content" /></p>
            <p><input type="Submit" name="Form_Submit" value="Send" /></p>
</form>
</div>
</body>
</html>


<!--<form name="myForm" method="post" class="pure-form pure-form-stacked" style="margin-left: 40%;>-->
<!--<table border='0' width="100%" style=";">-->
<!--<tr>-->
<!--    <td>Email</td>-->
<!--    <td><input type="email" name="email" value="--><?//=$email?><!--" pattern=".{1,}" required title="Cannot be empty field" size="30">-->
<!--        <span class="error">--><?php //echo $error_email?><!--</span></td>-->
<!--    <td>-->
<!--</tr>-->
<!--<tr>-->
<!--    <td>Password</td>-->
<!--    <td><input type="password" name="password" value="--><?//=$password?><!--" pattern=".{6,}" required title="6 characters minimum" size="30">-->
<!--        <span class="error">--><?php //echo $error_passwd?><!--</span></td>-->
<!--</tr>-->
<!--<tr>-->
<!--    <td><br></td>-->
<!--    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary"></td>-->
<!--    <td><input type="reset" name="reset" value="Cancel" class="pure-button pure-button-primary"></td>-->
<!--</tr>-->
<!--<tr>-->
<!--    <td></td>-->
<!--    <td>-->
<!--        <div class="error">--><?//=$formerror?><!--</div>-->
<!--        <br><a class="pure-button" href="register.php">Register Now</a>-->
<!--        <a class="pure-button" href="../../forgetpassword.php">Forget Password</a>-->
<!--    </td>-->
<!--</tr>-->
<!--</table>-->
<!--</form>-->

<?php
include '../../includes/footer.php';
?>