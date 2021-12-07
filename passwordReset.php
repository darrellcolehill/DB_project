<?php
session_start();
 
// Don't allow a user that isn't logged in to reset the password.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include db connection
require_once "db_connection.php";
 

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Get both passwords from form
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if password is empty
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    }
    else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Check if confirm password is empty
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please enter the password again.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // If there are no errors, continue
    if(empty($new_password_err) && empty($confirm_password_err)){
        // create update statement to change password
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ss", $param_password, $param_email);
            
            $param_password = $new_password;
            $param_email = $_SESSION["email"];
            
            if($stmt->execute()){
               
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
</body>
</html>