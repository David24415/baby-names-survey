<?php
require_once './php/db_connect.php';
 $name = "David"; 
$gender = "NULL"; 
        if(isset($_POST['name'])){
$name = mysqli_real_escape_string($db, $_REQUEST['name']);
            if(!preg_match("/^[a-zA-Z]*$/",$name)||empty($name)){
                echo '<script type="text/javascript">
                    alert("enter a name");
                    </script>';

               // Echo("Please complete form before submitting!");
                goto a;
            }
        }

// Add two rows to the table
        if (isset($_POST['gender'])) {
            if($_POST['gender']=='girl'){
        $gender='F';
        }
            if($_POST['gender']=='boy') {
        $gender='M';
    }
        $insertStmt = "INSERT INTO Babynames1 (id,count,name,gender)
             VALUES (NULL,1,'$name','$gender')
             ON DUPLICATE KEY UPDATE count = count+1";
        }
        else{
            /*echo '<script type="text/javascript">
                    alert("select a gender");
                    </script>';*/
                goto a;}
if($db->query($insertStmt)) {
   
      $name = "";  
    header('Location: php/thanks.php');
    
} else {
   
    exit();
}
   a:



echo <<<_END
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="css/styles.css" rel="stylesheet">
<link href="css/p6.css" rel="stylesheet">
<title>Baby names survey</title>
    </head>
<body>
<div class="navbar navbar-default">
<div class="container">
<h1 id="navbar"><strong>Baby Names Survey</strong>
</h1>
</div>
</div>
<div class="container">
<div class ="bbGirl">
<img src="img/girl.png" alt="Baby Girl" width="100" height="100">
</div>
<div class ="bbBoy">
<img src="img/boy.png" alt="Baby Boy" width="100" height="100">
</div>
<div class="jumbotron text-center">
    <form action="index.php" method="post">
        <p> Please select the gender to vote for*</p>
        <input type="radio" name="gender" value="girl"/> Girl<br />
        <input type="radio" name="gender" value="boy"/> Boy<br />
        <br>
        <p> Enter the name you would like to vote*</p>
        <input type="text" name="name" id="name" />
        <input type="submit" id="submit" name"submit" value="Send it!">
<p><strong>*</strong> <small>sections must be complete to process survey</small></p>
    </form>
</div>
</div>

<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script src="js/p6.js"></script>
    </body>
</html>
_END;

// Get the rows from the table
        echo'<div class="navbar1 navbar-default">';
        $selectStmt = 'SELECT * FROM `Babynames1` WHERE gender="M" ORDER BY count DESC  LIMIT 10;';
$result = $db->query($selectStmt);
if($result->num_rows > 0) {
    echo'<div id="Bdisplay"><h1>Top 10 Boy names</h1><p><strong>name- # of votes</strong></p>'.PHP_EOL;
    while($row = $result->fetch_assoc()) {
        /*echo ' <p> name: ' . $row["name"] . '  number of votes: ' . $row["count"] .'</p>' . PHP_EOL;*/
        
        echo''.$row["name"].'&nbsp;'.$row["count"].'

        '.PHP_EOL;
        echo"<br>";
    }
    echo'</div>';
} else {
    echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
}

 $selectStmt1 = 'SELECT * FROM `Babynames1` WHERE gender="F" ORDER BY count DESC LIMIT 10;';
$result1 = $db->query($selectStmt1);
if($result1->num_rows > 0) {
    echo'<div id="Gdisplay"><h1>Top 10 Girl names</h1><p><strong>name- # of votes</strong></p>'.PHP_EOL;
    while($row = $result1->fetch_assoc()) {
        /*echo ' <p> name: ' . $row["name"] . '  number of votes: ' . $row["count"] .'</p>' . PHP_EOL;*/
        
        echo''.$row["name"].'&nbsp;'.$row["count"].'

        '.PHP_EOL;
        echo"<br> ";
    }
    echo'</div>';
} else {
    echo '        <div class="alert alert-success">No Results</div>' . PHP_EOL;
}
        echo'</div>';

?>



