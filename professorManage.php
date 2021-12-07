
<html>
    <body>
        <style>
            table, th, td {
            border:1px solid black;
            }
            input{
                width: 97%;
            }
        </style>
<?php include_once('db_connection.php'); 
session_start();



 

            $query = "SELECT * FROM users WHERE admin = '0'";
            
            if ($result = $conn->query($query)) {
                ?>
                <table style="width:100%">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                <?php
            
                while ($row = $result->fetch_assoc()) {

                    $username = $row["username"];
                    $email = $row["email"];
                    ?>

                    <tr>
                        <td><?php echo $username?></td>
                        <td><?php echo $email?></td>
                        <td><?php echo "<button><a href='http://localhost/DB_project/sendIndividualReminder.php?email=$email'>Send Reminder Email</a></button>" ?></td> 
                        
                    </tr>                    
                    <?php

                }
            //change link above to route to email page.

            $result->free();
            }
        ?>    
    </body>
</html>      