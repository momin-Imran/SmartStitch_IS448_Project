<!-- 
 Author : Taurus Hink
 Description : This page will provide the user with a form to notify their selected tailor of any concerns they might have, including allergens, resizing, their order's
              status, concerns about their order after they have recieved the product, and any other concerns they may have. This form submits data for processing.

 -->

<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include_once('config.php');
	session_start();

	if (!isset($_SESSION["user_id"])) {
		header("Location: $BASE_URL/customer/cust_login.php");
		exit();
	}
		
	
	
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

        if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");
?>

<!DOCTYPE html>
<html lang="EN">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User-Tailor Communication</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>
	<header id="navbar"></header>
	<script>
		// Load the navbar from the external file
		fetch('<?php echo $BASE_URL; ?>/navbar.php')
			.then(response => response.text())
			.then(data => document.getElementById('navbar').innerHTML = data);
	</script>

	<h1> User to Tailor Communictaion </h1>

	<br>

	<div>
		<!-- This div tag is for the informational pharagraph on the page -->
		<p>
			On this page, you can communicate with your selected tailor about potential issues such as chemical and fabric allergies and any other problems that you may
			have missed when ordered custom fitted clothes. You may also contact past tailors about order problems or related concerns.
		</p>

	</div>

	<br>

	<div>
		<!-- This div tag is for the page's input form -->

		<h2> Communication Form </h2>

		<form action="communication.php" method="POST">

			<label>
				Enter your tailor's name :
				<input type="text" name="tailor">
			</label>

			<br>

			<label>
				Is this for a current or past order?
			</label>
			<label>
				<input type="radio" name="status" value="current"> Current Order
			</label>
			<label>
				<input type="radio" name="status" value="past"> Past Order
			</label>




			<br>
			
			<!-- Allergens section -->
			
			<label>
				Do you need to add a potential allergen of concern?
			</label>
			<label>
				<input type="radio" name="ifAllerg" value="yes"> Yes
			</label>
			<br>
			<label>
				<input type="radio" name="ifAllerg" value="no"> No
			</label>
			
			<br>
			
			<label>
				Type any allegen in the following space (Type N/A if you picked "No" for the last option) :
				<input type="text" name="allergens">
			</label>

			<br>
			
			<label>
				What level of severity is this allergen (pick N/A if there is no allegen to add)?
			</label>
			<label>
				<input type="radio" name="severity" value="N/A"> N/A
			</label>
			<label>
				<input type="radio" name="severity" value="Mild"> Mild
			</label>
			<label>
				<input type="radio" name="severity" value="Moderate"> Moderate
			</label>
			<label>
				<input type="radio" name="severity" value="Severe"> Severe
			</label>
			
			<br>
			
	
			
			<label>
				Do you need to resize any dimension of your order?
			</label>
			<label>
				<input type="radio" name="ifResize" value="yes"> Yes
			</label>
			<br>
			<label>
				<input type="radio" name="ifResize" value="no"> No
			</label>
			
			<label>
				Select which dimension of your order you wish to resize (Select N/A if you picked "No" for the last option) : 
			</label>
			<select name="dimen">
				<option value="N/A"> N/A </option>
				<option value="chest"> Chest </option>
				<option value="waist"> Waist </option>
				<option value="neck"> Neck </option>
				<option value="shoulder"> Shoulders </option>
				<option value="arm"> Arms </option>
				<option value="inseam"> In-seam </option>
				<option value="hips"> Hips </option>
				<option value="rise"> Rise </option>
				<option value="other"> Other </option>
			</select>
			
			<br>
			
			<label>
				If you chose "other" for the last option, please input dimension here (Type N/A if you did not) :
				<input type="text" name="otherDim">
			</label>
			
			<br>
			
			<label>
				Type the specifications in the space below (Type N/A if you picked "N/A" for the last option) :
				<input type="text" name="resize">
			</label>
			
			<label>
				Do you have any other special instructions in regards to this dimension?
			</label>
			<label>
				<input type="radio" name="ifDimSpec" value="yes"> Yes
			</label>
			<br>
			<label>
				<input type="radio" name="ifDimSpec" value="no"> No
			</label>
			
			<label>
				If you chose "Yes" for the last option, specify here (Type N/A if you did not) :
				<input type="text" name="dimSpec">
			</label>

			<br>
			
			
			<label>
				Do you need to check the status of an undelivered order? If so, your tailor will send a response to the email attached to your account.
			</label>
			<label>
				<input type="radio" name="undel" value="yes"> Yes
			</label>
			<label>
				<input type="radio" name="undel" value="no"> No
			</label>

			<br>

			<label>
				If you have any concerns or are unsatisfied about your order, type them here :
				<input type="text" name="concerns">
			</label>

			<br>

			<label>
				If you have any other concerns for your tailor to address, type them here :
				<input type="text" name="other">
			</label>

			<br>

			<input type="submit" value="Submit this form">

			<br>

			<input type="reset" value="Reset this form">

		</form>

	</div>

	<br>

	<div>
		<!-- This div tag is for the thank you message -->
		<p>
			Thank you for using SmartStitch! We hope you are satisfied with our service.
		</p>

	</div>


	<header id="footer"></header>
	<script>
		fetch('<?php echo $BASE_URL; ?>/footer.html')
			.then(response => response.text())
			.then(data => document.getElementById('footer').innerHTML = data);
	</script>

</body>
