<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/signup.css">

    <script src="js/app.js"></script>
</head>

<body>
   <?php 
    include("partials/connection.php");

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstNameErr = $lastNameErr = $emailErr = $passErr = "";
    $firstName = $lastName = $email = $password = $confpassword = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include("partials/connection.php");

        $firstName = test_input($_POST['firstName']);
        $lastName = test_input($_POST['lastName']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $confpassword = test_input($_POST['confpassword']);

        // Validate required fields:
        // first name
        if (empty($firstName)) {
            $firstNameErr = "First name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $firstNameErr = "Only letters and white space allowed for first name";
        }

        // last name
        if (empty($lastName)) {
            $lastNameErr = "Last name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $lastNameErr = "Only letters and white space allowed for last name";
        }

        // email
        if (empty($email)) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $email = test_input($_POST['email']);
            $emailExistsQuery = "SELECT * FROM `logininfo` WHERE `email` = '$email'";
            $emailResult = mysqli_query($conn, $emailExistsQuery);
            $emailCount =  mysqli_num_rows($emailResult); //gives the no of rows where this email exists
            if ($emailCount > 0){
                $emailErr = "Email already exists";
            }
        }

        // Validate password and confirm password
        if (empty($password)) {
            $passErr = "Password is required";
        } elseif ($password !== $confpassword) {
            $passErr = "Passwords do not match";
        }

        // if no errors run query
        if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($passErr)) {
            // hashing password
            // $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO `logininfo` (`firstName`, `lastName`, `email`, `password`, `dt`) VALUES ('$firstName', '$lastName', '$email', '$password', current_timestamp());";
            $result = mysqli_query($conn, $insertQuery);

            echo '<div class="alert alert-success" role="alert">Data inserted successfully!</div>';
        } 
    }
?>

    <div class="container">
        <div class="title">
            <h1>Signup</h1>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form">
                <div class="form-row name">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    <?php
                        if(!empty($firstNameErr)){
                            echo '<span class="error">' . $firstNameErr . '</span>';
                        }
                    ?>
                </div>

                <div class="form-row name">
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                    <?php
                        if(!empty($lastNameErr)){
                            echo '<span class="error">' . $lastNameErr . '</span>';
                        }
                    ?>
                </div>

                <div class="form-row email">
                    <input type="text" id="email" name="email" placeholder="Email">
                    <?php
                        if(!empty($emailErr)){
                            echo '<span class="error">' . $emailErr . '</span>';
                        }
                    ?>
                </div>

                <div class="form-row password">
                    <input type="password" id="password" name="password" placeholder="Create Password" onkeyup="checkPassword()">
                </div>

                <div class="form-row conf-password">
                    <input type="password" id="conf-password" name="confpassword" placeholder="Confirm Password" onkeyup="checkPassword()">
                    <!-- <span class="message">Passwords don't match</span> -->
                    <?php
                        if(!empty($passErr)){
                            echo '<span class="error">' . $passErr . '</span>';
                        }
                    ?>
                </div>
            </div>

            <div class="form-button">
                <button type="submit">Signup</button>
            </div>

            <div class="login-link">
                <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
