<?php
    include_once('db_connection.php');


    if(isset($_GET['add'])) {

        $username = 'b'; // TODO: change to get this from cookie
        $semester = $_GET['semester'];

        $query = "INSERT INTO request (username, semester) 
        VALUES ('{$username}', '{$semester}')";


        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/viewAllBookRequest.php"); 
        } 
        else{
            echo "Request form already exist";
        }
    }

    if(isset($_GET['delete'])) {

        $username = 'b'; // TODO: change to get this from cookie
        $semester = $_GET['semester'];

        $query = "DELETE FROM request WHERE username = '{$username}' AND semester = '{$semester}'";
        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/viewAllBookRequest.php"); 
        } 
        else{
            echo "ERROR: Could not able to execute $query. ";
        }
    }


    // Attempt insert query execution
    // CODE TO INSERT INTO THE users TABLE
    /*
    $sql = "INSERT INTO users (username, password, lastname, email, admin) VALUES
    ('b', 'b', 'b', 'b', 0)";
    if($conn->query($sql)){
    echo "Records added successfully.";
    } else{
    echo "ERROR: Could not able to execute $sql. ";
    }
    */

    // CODE TO INSERT INTO THE request TABLE
    /*
    $sql = "INSERT INTO request (username, semester) VALUES
    ('b', 'FALL22')";
    if($conn->query($sql)){
    echo "Records added successfully.";
    } else{
    echo "ERROR: Could not able to execute $sql. ";
    }
    */

    // CODE TO INSERT INTO THE books TABLE
    /*
    $sql = "INSERT INTO books (username, semester, ISBN, title, authors, edition, publisher) VALUES
    ('b', 'FALL22', '222222222', 'title2', 'author2', 'ed2', 'pub2')";
    if($conn->query($sql)){
    echo "Records added successfully.";
    } else{
    echo "ERROR: Could not able to execute $sql. ";
    }
    */

    // QUERY TO GET ALL BOOK WITH SPECIFIED USERNAME AND SEMESTER 
    /*
    $query = "SELECT * FROM books
    WHERE EXISTS
    (
        SELECT * FROM request
        WHERE books.username='{$username}' and books.semester=request.semester
    )";
    */

    
    // CODE AND QUERY TO DISPLAY ALL BOOK WITH GIVEN USERNAME AND SEMESTER
    /*
    $query = "SELECT * FROM books WHERE username = '{$field1name}' AND semester = '{$field2name}'";

    if ($result2 = $conn->query($query)) {
        echo '<b>'.$field2name.'</b> </br>';
        while ($row2 = $result2->fetch_assoc())
        {

            echo '<b>'.$row2["ISBN"].'</b> ';
            echo '<b>'.$row2["title"].'</b> ';
            echo '<b>'.$row2["authors"].'</b> ';
            echo '<b>'.$row2["edition"].'</b> ';
            echo '<b>'.$row2["publisher"].'</b></br>';
        }
        $result2->free();
    }
    */

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
            $username = "b"; // TODO: change this to the user name stored in the cookie created during login

            $query = "SELECT semester FROM request WHERE username = '{$username}'";
            
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