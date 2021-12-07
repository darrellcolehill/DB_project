<?php
// Initialize the session
session_start();


// connection to DB
require_once "db_connection.php";
 

$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Get email and login from form
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // check for empty form
    if(empty($_POST["email"])){
        $email_err = "Email missing.";
    } else{
        $email = ($_POST["email"]);
    }
    
    // Check for empty form
    if(empty($_POST["password"])){
        $password_err = "Password missing.";
    } else{
        $password = ($_POST["password"]);
    }
    
    // If there are no errors, check if email and password match the values from the database
    if(empty($email_err) && empty($password_err)){


        $sql = "SELECT admin, email, password FROM users WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){


            $stmt->bind_param("s", $param_email);
            
            $param_email = $email;
            
            if($stmt->execute()){

                $stmt->store_result();
                
                // If the email exists, check if the password matches
                if($stmt->num_rows == 1){                    
                    // Bind admin, email, and password
                    $stmt->bind_result($admin, $email, $real_pass);
                    if($stmt->fetch()){
                        if($password == $real_pass){

                            session_start();
                            
                            // Now that we've logged in start a new session with new variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;
                            $_SESSION['admin'] = $admin;
                            

                            // Expire session after 30 minutes.
                            $_SESSION['start'] = time();
                            $_SESSION['expire'] = $_SESSION['start'] + (60 * 30);              
                            
                            // Redirect user to admin page or professor page depending on admin value.

                            if($admin == 1)
                            {
                                header("location: http://localhost/DB_project/adminPage.php");
                            }
                            else
                            {
                                header("location: http://localhost/DB_project/viewAllBookRequest.php");
                            }

                            
                        } else{
                            // There was some error.
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else{
                    //There was an email error.
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Sorry, looks like something went wrong on our end. Please try again later.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin:auto; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in the form below to log in.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Register now</a>.</p>
            <p>Forgot Password? <a href="tempPassword.php">Request temporary password</a>.</p>
        </form>
    </div>
</body>
</html>