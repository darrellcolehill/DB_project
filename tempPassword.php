

<?php
session_start();
// Include config file
require_once "db_connection.php";
$email = $password = "";
$email_err  = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    }
    else{
        $email = trim($_POST["email"]);
    }
    $password = random_int(100000, 999999);


    // Check input errors before updating the database
    if(empty($email_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_password, $param_email);
            
            // Set parameters
            $param_password = $password;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page

                $to = $email;
                $subject = 'Temporary Password';
                $message = "Hi, your temporary password is: {$password}\r\n please login at: http://localhost/DB_project/login.php";
                $header = "From: dbprojectfall21@gmail.com\r\nReply-To: dbprojectfall21@gmail.com";
                $mail_sent = mail($to, $subject, $message, $header);
        
                mail($to, $subject, $message, $headers);

                //session_destroy();
                header("location: login.php");
                //exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>











</html>
<body>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <p>Please fill this form to request a temporary password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            </form>
    </div>    
</body>
</html>