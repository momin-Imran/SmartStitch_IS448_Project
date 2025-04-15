<!DOCTYPE html>
<html lang="EN">

<head>
    <title>register.php</title>
    <link rel="stylesheet" type="text/css" href="form_proc.css" />
</head>

<body>
    <?php
    #connect to mysql database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    #get the parameter from the HTML form that this PHP program is connected to
    #since data from the form is sent by the HTTP POST action, use the $_POST array here
    if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['last_name']) && !empty($_POST['last_name']) && isset($_POST['first_name']) && !empty($_POST['first_name']) ) {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $title = $_POST['title'];
        




        #construct a query
        $constructed_query = "INSERT INTO register (title, first_name, last_name, email, password) VALUES ('$title', '$first_name', '$last_name', '$email', '$password')";

        #Execute query
        $result = mysqli_query($db, $constructed_query);

        #if result object is not returned, then print an error and exit the PHP program
        if (! $result) {
            print("Error - query could not be executed");
            $error = mysqli_error($db);
            print "<p> . $error . </p>";
            exit;
        }
    ?>
        <!--if program reaches this print statement, it means the query worked-->
        <h3>Sanity check print statement:</h3> If this line is reached in the program, it means that the query worked
        <br />
    <?php
    } else {
        echo "all fields must be filled out";
    }
    ?>


</body>

</html>