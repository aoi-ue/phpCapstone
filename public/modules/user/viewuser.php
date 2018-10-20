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



	if(isset($_GET["id"]))
	{
	  $UM=new UserManager();
	  $viewuser=$UM->getUserById($_GET["id"]);
	  $firstName=$viewuser->firstName;
	  $lastName=$viewuser->lastName;
	  //$email=$existuser->email;
	  $companyName=$viewuser->companyName;
	  $city=$viewuser->city;
	  $country=$viewuser->country;
	  //$password=$existuser->password;
	}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="deleteUser" method="post" class="pure-form pure-form-stacked">
<h1><strong>Profile</strong></h1>


<table width="800">

   <tr>
   <td>First Name:</td>
    <td><?=$firstName?></td>
	</tr>
	<tr>
	<td>Last Name:</td>
	<td><?=$lastName?></td>
  </tr>
  	<tr>
	<td>Company Name:</td>
	<td><?=$companyName?></td>
  </tr>
  	<tr>
	<td>City:</td>
	<td><?=$city?></td>
  </tr>
  	<tr>
	<td>Country:</td>
	<td><?=$country?></td>
  </tr>
  
  <tr>
	<td></td>
    <td><a class="pure-button" href="userlistsearch.php">Back</a>
    </td>
    </td>
  </tr>
</table>

</form>


<?php
include '../../includes/footer.php';
?>