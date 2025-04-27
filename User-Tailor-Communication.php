<!-- 
 Author : Taurus Hink
 Description : This page will provide the user with a form to notify their selected tailor of any concerns they might have, including allergens, resizing, their order's
              status, concerns about their order after they have recieved the product, and any other concerns they may have. This form submits data for processing.

 -->

<?php
include_once('config.php');
// include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

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
		fetch('<?php echo $BASE_URL; ?>/navbar.html')
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
			<!-- This currently doesn't lead to a php page, the action is a placeholder for now. -->

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

			<label>
				Type any allegies in the following space (Type N/A if you have no relavent allergies) :
				<input type="text" name="allergens">
			</label>

			<br>

			<label>
				If you need to resize your order, type the specifications in the space below (Type N/A if you do not need to) :
				<input type="text" name="resize">
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