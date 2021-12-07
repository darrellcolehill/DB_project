<?php
    
    
    if(isset($_GET['viewFinalRequest']))
    {
        $semester = $_GET['semester'];
        header("Location: http://localhost/DB_project/listOfRequest.php?semester=$semester");
      //  echo "user search semester";
    }
?>





<html>

</head>
    <style type="text/css">
        form input[type="submit"]{

            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>

</head>


<h2>Administrator</h2>
    <body>
        <form method="get">
            <p>Register a new admin? <a href="http://localhost/DB_project/adminRegister.php">Register</a>.</p>
            <p>Reset Password? <a href="http://localhost/DB_project/passwordReset.php">Reset</a>.</p>            
            <p>Manage Admin Accounts <a href="http://localhost/DB_project/adminManage.php">Manage</a>.</p>
            <p>Manage Professor Accounts / Send Individual Email <a href="http://localhost/DB_project/professorManage.php">Manage</a>.</p>            
            <p>Broadcast Email to Professors <a href="http://localhost/DB_project/broadcastEmail.php">Manage</a>.</p>
            <p>Schedule Email <a href="http://localhost/DB_project/scheduleEmail.php">Manage</a>.</p>
            <p>Create Final List of Books for Upcoming Semester <a href="http://localhost/DB_project/finalBookRequestForm.php">Manage</a>.</p>
            <p>View All Book Requests For Given Semester.</p> 
            <input type='text' name='semester' value='enter semester'> <input type='submit' name='viewFinalRequest' value="Search">
        
        </form>
    </body>

</html>

