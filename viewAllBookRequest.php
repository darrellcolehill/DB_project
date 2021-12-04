<?php
    include_once('db_connection.php');


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
    <body>

        <?php

            $username = "b"; // TODO: change this to the user name stored in the cookie created during login

            $query = "SELECT semester FROM request WHERE username = '{$username}'";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {
                    $semester = $row["semester"];
                    echo '<b>'.$row["semester"]."</b> </br></br>";
                    echo "<p><a href='http://localhost/DB_project/viewEditBookRequest.php?semester=$semester'>View/Edit</a></p>"
                ?>
                    <?php

                    $semester = $row["semester"];
                    echo '</br></br>';

                }
            
            /*freeresultset*/
            $result->free();
            }


        ?>
    </body>
</html>








