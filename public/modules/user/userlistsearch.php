<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\Validation;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
session_regenerate_id(TRUE);

//validation 
$formerror="";

$firstName="";
$lastName="";
$companyName="";
$city="";
$country="";

//$error_auth="";
$error_fname="";
//$error_lname="";
//$error_cname="";
//$error_city="";
//$error_country="";
//$validate=new Validation();
//$validate1=new Validation();
//$validate2=new Validation();
//$validate3=new Validation();
//$validate3=new Validation();




if(isset($_POST["submitted"])){
	
	$firstName=$_POST["firstName"];
	$lastName=$_POST["lastName"];
	$companyName=$_POST["companyName"];
	$city=$_POST["city"];
	$country=$_POST["country"];


		$UM=new UserManager();

		$users=$UM->search($firstName,$lastName,$companyName, $city, $country);
		//print_r($users);
} else
	{$UM=new UserManager();
	$users=$UM->getAllUsers();
	//print_r($users);
	}


if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
	<form class="pure-form" method="post" action="userlistsearch.php">
    <fieldset>
        <h2>Search Form</h2>

        <input type="text" placeholder="First Name" name="firstName">
        <input type="text" placeholder="Last Name" name="lastName">
		<input type="text" placeholder="Company Name" name="companyName">
		<input type="text" placeholder="City" name="city">
		<input type="text" placeholder="Country" name="country">

        <button type="submit" class="pure-button pure-button-primary" name="submitted">Search</button>
    </fieldset>
</form>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
             <!--  <th><b>Id</b></th>-->
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>      
			  <th><b>Company Name</b></th> 
			   <th><b>City</b></th> 
			   <th><b>Country</b>
			   <th><b>Profiles</b>
			   </thead>
            </tr>    
    <?php 

	foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <!--<td><?=$user->id?>company name city country</td>-->
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
			   <td><?=$user->companyName?></td>
			   <td><?=$user->city?></td>
			   <td><?=$user->country?></td>
			   			   <td>
					<a href='viewuser.php?id=<?php echo $user->id ?>'>View</a>
					
			   </td>

            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
    <?php 
}
?>



<?php
include '../../includes/footer.php';
?>