<!--
	Author : Taurus Hink
	Description : The page that userTailorCom.php leads to after taking user input from its form. This page will update the sql database with information input on the previous
				  page's form and print back the input information to ensure correctness. 
--!>
session_start();

<?php
	include_once('config.php');
	
	$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

        if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");
	
	if (isset($_SESSION["user_id"]) 
	{
		$user = $_SESSION["user_id"];
		
		$allergenSet = if ((isset($_POST["ifAllerg"]) && !empty($_POST["ifAllerg"])) &&
		                   (isset($_POST["allergens"]) && !empty($_POST["allergens"])) &&
			           (isset($_POST["severity"]) && !empty($_POST["severity"]))
				  );
						  
		$sizeSet = if ((isset($_POST["ifResize"]) && !empty($_POST["ifResize"])) &&
		               (isset($_POST["dimen"]) && !empty($_POST["dimen"])) &&
			       (isset($_POST["otherDim"]) && !empty($_POST["otherDim"])) &&
			       (isset($_POST["resize"]) && !empty($_POST["resize"]))
			       (isset($_POST["ifDimSpec"]) && !empty($_POST["ifDimSpec"])) &&
			       (isset($_POST["dimSpec"]) && !empty($_POST["dimSpec"]))
			      );
		
		if ((isset($_POST["tailor"]) && !empty($_POST["tailor"])) &&
			(isset($_POST["status"]) && !empty($_POST["status"])) &&
			(isset($_POST["undel"]) && !empty ($_POST["undel"])) &&
			(isset($_POST["concerns"]) && !empty ($_POST["concerns"])) &&
			(isset($_POST["other"]) && !empty ($_POST["other"])) &&
			($allergenSet) &&
			($sizeSet)
		   ) {
				$tailor = mysqli_real_escape_string($db, $_POST["tailor"]);
				
				$ifAllerg = $_POST["ifAllerg"];
				$allergens = mysqli_real_escape_string($db, $_POST["allergens"]);
				$severty = $_POST["severty"];
				
				$ifResize = $_POST["ifResize"];
				$dimen = $_POST["dimen"];
				$otherDim = mysqli_real_escape_string($db, $_POST["otherDim"]);
				$resize = mysqli_real_escape_string($db, $_POST["resize"]);
				$ifDimSpec = $_POST["ifDimSpec"];
				$dimSpec = mysqli_real_escape_string($db, $_POST["dimSpec"]);
				
				$concerns = mysqli_real_escape_string($db, $_POST["concerns"]);
				$other = mysqli_real_escape_string($db, $_POST["other"]);
				
				$orderStatus = $_POST["status"];
				$deliveryStatus = $_POST["undel"];
				
				$appendAllergens = "INSERT INTO Allergens(customer_id, allergen, severity) VALUES ($user , $allergens , $severty)";
				
				if ($dimen == "chest") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, chest) VALUES ($user , $resize)";
					if ($ifDimSpec) {
						$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId;
					}
					
				} else if ($dimen == "waist") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, waist) VALUES ($user , $resize)";
					if ($ifDimSpec) {
     						$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "neck") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, neck) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "shoulder") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, shoulder) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "arm") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, arm) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "inseam") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, inseam) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "hips") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, hips) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "rise") {
					
					$appendSize = "INSERT INTO SizePrefs(customer_id, rise) VALUES ($user , $resize)";
					if ($ifDimSpec) {
          					$sizeId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefs SET specInst=$dimSpec WHERE size_id=$sizeId";
					}
					
				} else if ($dimen == "other") {
					$appendSize = "INSERT INTO SizePrefsOther(dimension, measure) VALUES ($otherDim , $resize)";
					if ($ifDimSpec) {
          					$prefId = mysqli_insert_id($db);
						$addSpec = "UPDATE SizePrefsOther SET specInst=$dimSpec WHERE pref_id=prefId";
					}
				}
				
				$messageDate = date("d/m/Y");
				$appendConcernMessage = "INSERT INTO OrderCom(com_date, concern) VALUES ($messageDate , $concerns)";
				$appendOtherMessage = "INSERT INTO OtherCom(com_date, concern) VALUES ($messageDate , $other)";
				
				if ($ifAllerg) {
					$resultAllerg = mysqli_query($db, $appendAllergens);
					if (! $resultAllerg) {
						print("Insertion Could not be performed");
						$error = mysqli_error($db);
						print("<p> . $error . </p>");
						exit;
					}
				}
				
				if ($ifResize) {
					$resultSize = mysqli_query($db, $appendSize);
					if (! $resultSize) {
						print("Insertion Could not be performed");
						$error = mysqli_error($db);
						print("<p> . $error . </p>");
						exit;
					}
					if ($ifDimSpec) {
						$resultDimSpec = mysqli_query($db, $addSpec);
						if (! $resultDimSpec) {
							print("Insertion Could not be performed");
							$error = mysqli_error($db);
							print("<p> . $error . </p>");
							exit;
						}
					}
				}
				
				$resultOrderCom = mysqli_query($db, $appendConcernMessage);
				if (! $resultOrderCom) {
					print("Insertion Could not be performed");
					$error = mysqli_error($db);
					print("<p> . $error . </p>");
					exit;
				}
				
				$resultOtherCom = mysqli_query($db, $appendOtherMessage);
				if (! $resultOtherCom) {
					print("Insertion Could not be performed");
					$error = mysqli_error($db);
					print("<p> . $error . </p>");
					exit;
				}
?>

<!DOCTYPE html>
<html lang="EN">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Communication Confirmation</title>
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

	<h1> Communication Confirmation </h1>
	
	<h2> Here is what you input on the last form : </h2>
	
	<?php 
	
				if($ifAllerg) { 
					print("<p> $allergens of $severity severity, </p> <br>");
				} else {
					print("<p> You did not add any allergens, </p> <br>");
				}
				
				if($ifResize) {
					print("<p> You changed the $dimen dimension to $resize");
					if ($ifDimSpec) {
						print(", with the following special instructions : <br> $dimSpec </p> <br>");
					} else {
						print(", </p> <br>");
					}
				}
	?>
	
	<p> You left the following message pertaining to your order : </p> 
	
	<br>
	
	<?php 
				print("<p> $concerns </p>");
	?>
	
	<br>
	
	<p> Other Messages you left : </p>
	
	<br>
	
	<?php 
				print("<p> $other </p>");
		    }
	} else {
		
		header("locaton: $BASE_URL/customer/cust_login.php");
		exit();
		
	}
	
	?>
	
	<br>
	
	<p> Thank you for reaching out! We suggest you expect a response from most tailors within 3 business days. </p>

</body>
