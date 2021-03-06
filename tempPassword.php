

<?php
session_start();
// Include config file
require_once "db_connection.php";
$email = $password = "";
$email_err  = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // check if email is empty
    if(empty($_POST["email"])){
        $email_err = "Please enter an email.";
    }
    else{
        $email = ($_POST["email"]);
    }

    // generate random 6 digit password
    $password = random_int(100000, 999999);


    if(empty($email_err)){
        // prepare to update the users table with a new password
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){

            $stmt->bind_param("ss", $param_password, $param_email);
            

            $param_password = $password;
            $param_email = $email;
            
            if($stmt->execute()){
                // if successful, send email with information about new password.

                $to = $email;
                $subject = 'Temporary Password';
                $message = "Hi, your temporary password is: {$password}\r\n please login at: http://localhost/DB_project/login.php";
                $header = "From: dbprojectfall21@gmail.com\r\nReply-To: dbprojectfall21@gmail.com";
                $mail_sent = mail($to, $subject, $message, $header);
        
                mail($to, $subject, $message, $headers);

                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    
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