<?php
// Get the db connection

require_once "db_connection.php";
$email = $name = $password = $confirm_password = "";
$email_err = $name_err =  $password_err = $confirm_password_err = "";

// Basically the same as register.php but generates a random 6 digit password.
if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty($_POST["email"])){
        $email_err = "Please enter an email.";
    }

     else{

        $sql = "SELECT email FROM users WHERE email = ?";
        
        if($stmt = $conn->prepare($sql)){

            $stmt->bind_param("s", $param_email);
            
            $param_email = ($_POST["email"]);
            
            if($stmt->execute()){

                $stmt->store_result();
                // there's already an email with this name.
                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = ($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }


    if(empty($_POST['name'])){
        $name_err = "Please enter a name.";
    }
    else{
        $name = ($_POST['name']);
    }

    //generate a random 6 digit password
    $password = random_int(100000, 999999);

    if(empty($email_err) && empty($name_err)){
        

        $sql = "INSERT INTO users (email, name, password, admin) VALUES (?, ?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){


            $stmt->bind_param("ssss", $param_email, $param_name, $param_password, $param_admin);
            

            $param_email = $email;
            $param_password = $password;
            $param_name = $name;
            $param_admin = 1;

            // send email if statement executed properly.
            if($stmt->execute()){

                $to = $email;
                $subject = 'Admin Account Created';
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an admin account.</p>
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
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            </form>
    </div>    
</body>
</html>