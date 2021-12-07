<?php

require_once "db_connection.php";
 

$email = $name = $password = $confirm_password = "";
$email_err = $name_err =  $password_err = $confirm_password_err = "";
 
// Get an email, a name, a password and a second password for confirmation from form.
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty.
    if(empty($_POST["email"])){
        $email_err = "Please enter an email.";
    }
     else{
        // Get email from users table to check if email already exists.
        $sql = "SELECT email FROM users WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            
            $param_email = ($_POST["email"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = ($_POST["email"]);
                }
            } else{
                echo "Sorry, looks like something went wrong on our end. Please try again later.";
            }

            $stmt->close();
        }
    }

    // make sure form input isn't empty.
    if(empty($_POST['name'])){
        $name_err = "Please enter a name.";
    }
    else{
        $name = ($_POST['name']);
    }
    
    if(empty($_POST["password"])){
        $password_err = "Please enter a password.";     
    } else{
        $password = ($_POST["password"]);
    }

    // make sure passwords are the same.
    if(empty($_POST["confirm_password"])){
        $confirm_password_err = "Please enter password.";     
    } else{
        $confirm_password = $_POST["confirm_password"];
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // If there are no errors, continue.
    if(empty($email_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err)){
        

        $sql = "INSERT INTO users (email, name, password) VALUES (?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            // bind email, name, and password.
            $stmt->bind_param("sss", $param_email, $param_name, $param_password);
            
            $param_email = $email;
            $param_password = $password;
            $param_name = $name;
            
            if($stmt->execute()){

                header("location: login.php");
            } else{
                echo "Sorry, looks like something went wrong on our end. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 18px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin:auto }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Create an account by filling out the below form.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>