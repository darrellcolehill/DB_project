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
<?php 

// get all admins and allow deletion of admins upon clicking a button.

include_once('db_connection.php'); 


session_start();

// check if delete is true and then reload page after deleting.
if(isset($_GET['delete']))
{
    $delete = $_GET['delete'];
    if($delete == 'true')
    {
        $email = $_GET['email']; 


        $query = "DELETE FROM users WHERE email = '{$email}'";
        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/adminManage.php"); 
        } 
        else{
            echo "ERROR: Could not able to execute $query. ";
        }
    }
    
     
}


 
// get all admins
$query = "SELECT * FROM users WHERE admin = '1'";

if ($result = $conn->query($query)) {
    ?>
    <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
    <?php

    // use url to pass value if user clicks the button.
    while ($row = $result->fetch_assoc()) {

        $name = $row["name"];
        $email = $row["email"];
        ?>

        <tr>
            <td><?php echo $name?></td>
            <td><?php echo $email?></td>
            <td><?php echo "<button><a href='http://localhost/DB_project/adminManage.php?delete=true&email=$email'>Delete</a></button>" ?></td>
        </tr>
        <?php

    }
    

$result->free();
}
        ?>    
    </body>
</html>      