<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="style/login.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anta&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="js/app.js"></script>
</head>


<?php 
include("partials/connection.php");
$showError = "";

function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include("partials/connection.php");
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM `logininfo` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // echo var_dump(mysqli_fetch_assoc($result));
    // echo var_dump($_POST);

    // if(password_verify($password, $row['password'])) {
    //     echo "Passwords match";
    // } else{
    //     echo "Passwords don't match";
    // }

    if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $dpassword = $row['password'];

            if ($password == $dpassword) {
                // Passwords match, redirect to display.php
                $_SESSION['email'] = $email;
                header("Location: display.php");
                exit();
            } else {
                // Passwords do not match
                $showError = "Invalid password";
            }
        }
        
    } else {
        // Error in query execution
        $showError = "Invalid credentials ";
    }
    
}

// if(password_verify($password, $row['password'])) {
            //     $_SESSION['email'] = $email;
            //     header("Location: display.php");
            //     exit();
            // } else {
            //     // Passwords do not match
            //     $showError = "Invalid password";
            // }

// Check if email exists
        // if (mysqli_num_rows($result) == 0) {
        //     $row = mysqli_fetch_assoc($result);
        //     $dpassword = $row['password'];

        //     // Verify password
        //     if ($password == $dpassword) {
        //         // Passwords match, redirect to display.php
        //         $_SESSION['email'] = $email;
        //         header("Location: display.php");
        //         exit();
        //     } else {
        //         // Passwords do not match
        //         $showError = "Invalid password";
        //     }
        // } else {
        //     // Email does not exist
        //     $showError = "Email not registered";
        // }

?>

<body>

    <div class="container">
        <div class="title">
            <h1>Login</h1>
        </div>
        <form action="login.php" method="post">
            <div class="form">
                <div class="form-row email">
                    <!-- <label for="email">Email</label> -->
                    <input type="email" id="email" name="email" placeholder="Email">
                    <?php
                        if(!empty($showError)){
                            echo '<span class="error">' . $showError . '</span>';
                        }
                    ?>
                </div>

                <div class="form-row password">
                    <!-- <label for="password">Password:</label> -->
                    <input type="password" id="password" name="password" placeholder="Create Password" onkeyup="checkPassword()">
                </div>
            </div>

            <div class="forgetPass">
                <a href="#">Forgot Password?</a>
            </div>


            <div class="form-button">
                <button type="submit">Login</button>
            </div>

            <div class="signup-link">
                <span>Don't have a account? <a href="#">Signup</a></span>
            </div>
        </form>
    </div>
</body>

</html>