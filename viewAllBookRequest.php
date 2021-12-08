<?php
    include_once('db_connection.php');

    // Gets the email from session data
    session_start();
    $email =  $_SESSION["email"];

    // checks if the add URL variable is asserted
    if(isset($_GET['add'])) {

        $semester = $_GET['semester'];

        // Query for inserting request
        $query = "INSERT INTO request (email, semester)  
                  VALUES ('{$email}', '{$semester}')";

        // If the request was able to be inserted, redirect to the same page
        // so the user can see the new changes
        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/viewAllBookRequest.php"); 
        } 
        else{
            echo "Request form already exist";
        }
    }

    // checks if the add URL variable is asserted
    if(isset($_GET['delete'])) {

        $semester = $_GET['semester'];

        // Query for deleting a specific request. With the current user's email and desired semester being the key
        $query = "DELETE FROM request WHERE email = '{$email}' AND semester = '{$semester}'";
        if ($result = $conn->query($query)) {
            // If the request was able to be inserted, redirect to the same page
            // so the user can see the new changes
            header("Location: http://localhost/DB_project/viewAllBookRequest.php"); 
        } 
        else{
            echo "ERROR: Could not able to execute $query. ";
        }
    }

?>


<!DOCTYPE html>

<html>

    <head>
        <style>

            table, th, td {
                border:1px solid black;
            }
            input{
                width: 90%;
            }
            #viewBnt
            {
                float: left;
            }
            #deleteBnt
            {
                float: right;
            }

            .center 
            {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>

    <body>
        
    <table  class="center" style="width:375px">
        <tr>
            <th>Semester</th>
            <th>Options</th>
        </tr>
        <?php

            $query = "SELECT semester FROM request WHERE email = '{$email}'";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {
                    $semester = $row["semester"];
        ?>

                    <tr>
                        <th style="width:250px"><?php echo $semester?></th>
                        <th style="width:125px"><?php echo "<button id='viewBnt'><a href='http://localhost/DB_project/viewEditBookRequest.php?semester=$semester'>VIEW</a></button>
                        <button id='deleteBnt'><a href='http://localhost/DB_project/viewAllBookRequest.php?delete=DELETE&semester=$semester'>DELETE</a></button>"?></th>
                    </tr>

                    <?php
                }
            
            $result->free();
            }
                    ?>

        <form method='GET'>
        <tr>
            <th><input type="text" name="semester" value="INPUT SEMESTER HERE"></th>
            <th><input type='submit' name='add' value='ADD'></th>
        </tr> 

        <a href="http://localhost/DB_project/passwordReset.php">Reset Password</a>

    </body>
</html>