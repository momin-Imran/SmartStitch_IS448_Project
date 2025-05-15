<!-- 
 Author : Taurus Hink
 Description : This page will provide the user with a form to notify their selected tailor of any concerns they might have, including allergens, resizing, their order's
              status, concerns about their order after they have recieved the product, and any other concerns they may have. This form submits data for processing.

 -->

<?php
	
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
	<script src="<?php echo $BASE_URL; ?>/UTCscript.js" type="text/javascript"></script>
    
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

		<form action="<?php echo $BASE_URL; ?>/communication.php" method="POST">

			<label>
				Enter your tailor's email :
				<input type="text" name="tailor" id="TEmail">
				<p class="errText" id="errTEmail"></p>
			</label>

			<br>

			<label>
				Is this for a current or past order?
			</label>
			<input type="radio" name="status" value="current" class="radioF" id="Cord" checked> 
			<label for="Cord" class="RadioLabel">Current Order </label>

			<input type="radio" name="status" value="past" class="radioF" id="Pord">
			<label for ="Pord" class="RadioLabel">Past Order </label>




			<br>
			
			<!-- Allergens section -->
			
			<label>
				Do you need to add a potential allergen of concern?
			</label>
			<input type="radio" name="ifAllerg" value="yes" class="radioF" id="Ayes" checked>
			<label for="Ayes" class="RadioLabel">Yes</label>

			<input type="radio" name="ifAllerg" value="no" class="radioF" id="Ano">
			<label for="Ano" class="RadioLabel">No</label>
			
			<br>
			
			<label>
				Type any allegen in the following space (Type N/A if you picked "No" for the last option) :
				<input type="text" name="allergens" id="Alname">
				<p class="errText" id="errAller"></p>
			</label>

			<br>
			
			<label>
				What level of severity is this allergen (pick N/A if there is no allegen to add)?
			</label>
			<input type="radio" name="severity" value="N/A" class="radioF" id="Aln">
			<label for="Aln" class="RadioLabel">N/A</label>

			<input type="radio" name="severity" value="Mild" class="radioF" id="Almi">
			<label for="Almi" class="RadioLabel">Mild</label>

			<input type="radio" name="severity" value="Moderate" class="radioF" id="Almo">
			<label for="Almo" class="RadioLabel">Moderate</label>

			<input type="radio" name="severity" value="Severe" class="radioF" id="Alse">
			<label for="Alse" class="RadioLabel">Severe</label>
			
			<br>
			
					
			
			<label>
				Do you need to resize any dimension of your order?
			</label>
			<input type="radio" name="ifResize" value="yes" class="radioF" id="Ryes" checked>
			<label for="Ryes" class="RadioLabel">Yes</label>

			<input type="radio" name="ifResize" value="no" class="radioF" id="Rno">
			<label for="Rno" class="RadioLabel">No</label>
			
			<label>
				Select which dimension of your order you wish to resize (Select N/A if you picked "No" for the last option) : 
			</label>
			<select name="dimen" id="preD">
				<option value="N/A" id="NAres"> N/A </option>
				<option value="chest" id="Cres"> Chest </option>
				<option value="waist" id="Wres"> Waist </option>
				<option value="neck" id="Nres"> Neck </option>
				<option value="shoulder" id="Sres"> Shoulders </option>
				<option value="arm" id="Ares"> Arms </option>
				<option value="inseam" id="INres"> In-seam </option>
				<option value="hips" id="Hres"> Hips </option>
				<option value="rise" id="Rres"> Rise </option>
				<option value="other" id="Othres"> Other </option>
			</select>
			
			<br>
			
			<label>
				If you chose "other" for the last option, please input dimension here (Type N/A if you did not) :
				<input type="text" name="otherDim" id="ODname">
				<p class="errText" id="errOdim"></p>
			</label>
			
			<br>
			
			<label>
				Type the specifications in the space below (Type N/A if you picked "N/A" for the last option) :
				<input type="text" name="resize" id="res">
				<p class="errText" id="errRes"></p>
			</label>
			
			<label>
				Do you have any other special instructions in regards to this dimension?
			</label>

			<input type="radio" name="ifDimSpec" value="yes" class="radioF" id="RSpyes" checked>
			<label for="RSpyes" class="RadioLabel">Yes</label>

			<input type="radio" name="ifDimSpec" value="no" class="radioF" id="RSpno">
			<label for="RSpno" class="RadioLabel">No</label>
			
			<label>
				If you chose "Yes" for the last option, specify here (Type N/A if you did not) :
				<input type="text" name="dimSpec" id="dSpec">
				<p class="errText" id="errSpecInst"></p>
			</label>

			<br>
			
			
			<label>
				Do you need to check the status of an undelivered order? If so, your tailor will send a response to the email attached to your account.
			</label>

			<input type="radio" name="undel" value="yes" class="radioF" id="Syes">
			<label for="Syes" class="RadioLabel">Yes</label>

			<input type="radio" name="undel" value="no" class="radioF" id="Sno" checked>
			<label for="Sno" class="RadioLabel">No</label>

			<br>

			<label>
				If you have any concerns or are unsatisfied about your order, type them here :
				<input type="text" name="concerns" value="N/A">
			</label>

			<br>

			<label>
				If you have any other concerns for your tailor to address, type them here :
				<input type="text" name="other" value="N/A">
			</label>

			<br>

			<input type="submit" value="Submit this form" id="sub">

			<br>

			<input type="reset" value="Reset this form">

			<br>

			<p class="errText" id="subErr"></p>

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
