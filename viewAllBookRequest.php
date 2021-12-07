<?php
    include_once('db_connection.php');


    if(isset($_GET['add'])) {

        $email = 'b@ucf.com'; // TODO: change to get this from cookie
        $semester = $_GET['semester'];

        $query = "INSERT INTO request (email, semester)  
                  VALUES ('{$email}', '{$semester}')";


        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/viewAllBookRequest.php"); 
        } 
        else{
            echo "Request form already exist";
        }
    }

    if(isset($_GET['delete'])) {

        $email = 'b@ucf.com'; // TODO: change to get this from cookie
        $semester = $_GET['semester'];

        $query = "DELETE FROM request WHERE email = '{$email}' AND semester = '{$semester}'";
        if ($result = $conn->query($query)) {
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
             $email = 'b@ucf.com'; // TODO: change to get this from cookie

            $query = "SELECT semester FROM request WHERE email = '{$email}'"; // TODO: CHANGE TO EMAIL
            
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
            
            /*freeresultset*/
            $result->free();
            }
                    ?>

        <form method='GET'>
        <tr>
            <th><input type="text" name="semester" value="INPUT SEMESTER HERE"></th>
            <th><input type='submit' name='add' value='ADD'></th>
        </tr> 


    </body>
</html>