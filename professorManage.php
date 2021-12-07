






<html>
    <body>
        <style>
            table, th, td {
            border:1px solid black;
            }
            input{
                width: 17%;
            }
        </style>
<?php include_once('db_connection.php'); 


// this page does two things: Send reminder emails and delete professors.
session_start();

    // Send reminder email using the URL to pass the email variable.
    if(isset($_GET['emailSubmit']))
    {
        $email = $_GET['email'];
        header("Location: http://localhost/DB_project/sendIndividualReminder.php?email=$email");
      //  echo "user search semester";
    }

    // check if delete is true and then reload page after deleting.
    if(isset($_GET['delete']))
    {
        if($_GET['delete'] == 'true')
        {
            $email = $_GET['email']; 

            $query = "DELETE FROM users WHERE email = '{$email}'";

            if ($result = $conn->query($query)) {
                header("Location: http://localhost/DB_project/professorManage.php"); 
            } 
            else{
                echo "ERROR: Could not able to execute $query. ";
            }
        }
    }


            
 

    $query = "SELECT * FROM users WHERE admin = '0'";
    
    if ($result = $conn->query($query)) {
        ?>
        <h2>Manage Professors</h2>
        <h3>Send Reminder Email To New Professor</h3>

        <form method="get">
        <input type='text' name='email' value='enter email'> <input type='submit' name='emailSubmit' value="Submit">
        <h3>Send Reminder Email To Existing Professor</h3>
        </form>


                <table style="width:50%">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Reminder</th>
                        <th>Delete</th>
                    </tr>
                <?php
            
                while ($row = $result->fetch_assoc()) {

                    $name = $row["name"];
                    $email = $row["email"];
                    ?>

                    <tr>
                        <td><?php echo $name?></td>
                        <td><?php echo $email?></td>
                        <td><?php echo "<button><a href='http://localhost/DB_project/sendIndividualReminder.php?email=$email'>Send Reminder Email</a></button>" ?></td>
                        <td><?php echo "<button><a href='http://localhost/DB_project/professorManage.php?delete=true&email=$email'>Delete</a></button>" ?></td> 
                        
                    </tr>                    
                    <?php

                }

            $result->free();
            }
        ?>    
    </body>
</html>      