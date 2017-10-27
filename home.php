<?php
	require_once 'database.php'; 
	session_start();
	
//print_r($_SESSION);
$fac_name = $_SESSION['user'];
?>
<html>
	<head>
	<title>home</title>
	<link rel="stylesheet" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
</head>

<body>
<ul>
  <li><a href="#home">Home</a></li>
  <li style="float:right"><a class="active" href="logout.php">Log Out</a></li>
</ul>
    <h1><center>Faculty Home Page<center></h1>

<div id="wrapper">
<div id="leftcolumn">
<?php
    //echo "Here";
	$stid = " SELECT * FROM faculty_courses where user_name ='$fac_name' ";	
	
	$result = @mysql_query($stid) or die("Could not process". mysql_error() );

	$row = mysql_fetch_array($result);

	$count = mysql_num_rows($result);
	//var_dump($count);

	if($count==0)
		{   //status check wheather status open or close
			echo '<h3>You can select maximum 3 courses!</h3>';
			$query = "SELECT * FROM courses where status='open'";
		    $run = mysql_query($query);
            echo '<table border="1">
            <tr>
			<td>Select -</td>
            <td>Courses You Can Register -</td>
			<td>Available Section -</td>
			<td>Current Status</td>
            </tr>';
            //show value with check box.checkbox will select and show c_name,section,status with the help of c_id from course table
			while ($row = mysql_fetch_assoc($run))
			{
				echo '<form action="" method="POST">
				<tr>
			
				<td><input class="single-checkbox" type="checkbox" name="checkbox[ '. $row["c_id"].'  ]" /></td>

				<td>'. $row["c_name"].'</td>
				<td>'. $row["section"].'</td>
				<td>'. $row["status"].'</td>
				</tr>';
			}
			echo '</table>';
			echo '<br><input type="submit" name="submit">';
			echo '</form>';				
	    }
	elseif($count>=3)
		{
			echo "Your Registration Is Already Completed";
		}
		//portion if some section registered and some not
	elseif($count > 0 && $count < 3)
		{
			$query = "SELECT * FROM courses where status='open'";
		    $run = mysql_query($query);
             echo '<table border="1">
            <tr>
			<td>Select -</td>
            <td>Courses You Can Register -</td>
			<td>Available Section -</td>
			<td>Current Status</td>
            </tr>';
            //select section with checkbox with the help of c_id from course table and show values in tables
			while ($row = mysql_fetch_assoc($run)) //
			{
				echo '<form action="" method="POST">
				<tr>
			
				<td><input class="single-checkbox" type="checkbox" name="checkbox[ '. $row["c_id"].'  ]" /></td> 

				<td>'. $row["c_name"].'</td>
				<td>'. $row["section"].'</td>
				<td>'. $row["status"].'</td>
				</tr>';
			}
			echo '</table>';
			echo '<br><input type="submit" name="submit">';
			echo '</form>';				
	    }

?>
</div>


<?php
/*
if(isset($_POST['checkbox'])) {
  print_r($_POST['checkbox']);//print all checked elements
}
*/

	 /* this section is for the faculty name where this is == first_name + last_name */
	 $query_for_concat = "SELECT * FROM faculty where user_name='$fac_name' ";
     $run_for_concat = mysql_query($query_for_concat);

		$row_for_concat = mysql_fetch_assoc($run_for_concat);
		$faculty_name_concat = $row_for_concat["first_name"].' '.$row_for_concat["last_name"];
		//echo($faculty_name_concat);
		/* end of the name concatanation */


if( $_SERVER["REQUEST_METHOD"] == "POST" ) //portion for insert value in faculty_course with concatanation value
{
	if(isset($_POST['checkbox']))
	{
			foreach($_POST['checkbox'] as $key => $value)   //key is c_id and value is on off
			{
				echo $key."</br>";
				$query_course = "SELECT * FROM courses where c_id='$key' ";
				$run_for_course = mysql_query($query_course);
				$row_for_course = mysql_fetch_assoc($run_for_course);
				
				$query_course_data = $row_for_course["c_name"];
				$query_section_data = $row_for_course["section"];
				
				$query_insert = " INSERT INTO faculty_courses( user_name,faculty_name,course_title,section ) VALUES ('$fac_name','$faculty_name_concat','$query_course_data','$query_section_data') ";
                $result_insert = @mysql_query($query_insert) or die("Could not process". mysql_error() );
                
                     if(!$result_insert) 
					{
						echo "Failed !";
					}
				    else 
				    {
						echo "Successfully Registered For A New Course!";
						echo "<br>";
				    }
				//update value 	
				$query_update = "UPDATE courses SET status='closed' WHERE c_id='$key' ";
				$result_update = @mysql_query($query_update) or die("Could not process". mysql_error() );
                     if(!$result_update) 
					{
						echo "Failed !";
					}
				    else 
				    {
						echo "Successfully Updated!";
						echo "<meta http-equiv='refresh' content='0'>";
				    }
			}

	    
	}
	else
	{
		echo "Select Courses For Registration";
	}
}

?>
<div id="rightcolumn">


<h2>Faculty Basic info</h2> 
	<?php
     $query = "SELECT * FROM faculty where user_name='$fac_name' ";
	 
	 
     $run = mysql_query($query);
	

        echo '<table border="1">
            <tr>
            <td>User Name </td>
            <td>First Name</td>
            <td>Last Name </td>
            <td>Email </td>
            <td>Phone</td>
            </tr>';
		
        while ($row = mysql_fetch_assoc($run)) //show value in faulty_basic// 
		{
			echo '<form action="" method="POST"><tr>
            <td>'. $row["user_name"] .'</td>
            <td>'. $row["first_name"]. '</td>
            <td>'. $row["last_name"].'</td>
            <td>'. $row["email"].'</td>
            <td>'. $row["phone"].'</td>
            </tr></form>';
			
			
        }
     echo '</table>';
	 ?>
	 

<br><br>
<hr>
     
<?php
		$query = "SELECT * FROM faculty_courses where user_name ='$fac_name'"; //show registered course in registered section
		$run = mysql_query($query);
		echo '<br>';
		echo '<h3>Courses I Have Registered</h3>';
		echo "Courses Registered: ";
		echo $count;
		echo "<br><br>";
        echo '<table border="1">
        <tr>
		<th>Course Title -</th>
        <th>Section</th>
		<th>Drop Course</th>
        </tr>';

		while ($row = mysql_fetch_assoc($run)) // go to delete.php with serial_no from faculty_course
		{
			echo '<form action="" method="POST">
			<tr>
			<td>'. $row["course_title"].'</td>
			<td>'. $row["section"].'</td>
			<td><button><a href=" delete.php?id=' .$row['serial_no'].' " >Drop Course</a></button></td>
			</tr>';
		}
		echo '</table>';
		echo '</form>';

?>


</div>

</div>
<script>

var limit = 3 - "<?php echo $count; ?>" ;
$('input.single-checkbox').on('click', function (evt) {
    if ($('.single-checkbox:checked').length > limit) {
        this.checked = false;
    }
});
</script>
	 </body>
</html>



