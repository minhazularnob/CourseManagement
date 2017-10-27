<?php

	require_once 'database.php'; 
	session_start();
	
	$del_id = $_GET['id']; //get id from serial_no
	echo $del_id;


if (isset($del_id))

	$query = "SELECT * FROM faculty_courses where serial_no='$del_id' ";
	$result = @mysql_query($query) or die("Could not process". mysql_error() );

	$row = mysql_fetch_assoc($result);
				
	$query_course_data = $row["course_title"];
	$query_section_data = $row["section"];
	
	
    if(!$result) 
	{
		echo "Failed !";
	}
	else 
	{
		echo "Successfully query done!";
	}
	//update course table before delete 
	$query_update = " select * from courses where c_name='$query_course_data' && section='$query_section_data' ";
	$result_update = @mysql_query($query_update) or die("Could not process". mysql_error() );
	
	$row_cid = mysql_fetch_assoc($result_update);
				
	$query_cid_data = $row_cid["c_id"];

	
    if(!$result_update) 
	{
		echo "Failed !";
	}
	else 
	{
		echo "Successfully Updated Again!";
		$query_update = "UPDATE courses SET status='open' WHERE c_id='$query_cid_data' ";
		$result_update = @mysql_query($query_update) or die("Could not process". mysql_error() );
        if(!$result_update) 
			{
			echo "Failed !";
		    }
			else 
			{
			echo "Successfully Updated!";
			}
	}
	//delete previous value after updating data in course table
    $query = "DELETE FROM faculty_courses WHERE serial_no='$del_id' ";
	$result = @mysql_query($query) or die("Could not process". mysql_error() );
    
	if(!$result) 
	{
		echo "Failed !";
	}
	else 
	{
		echo "Successfully Dropped Course!";
		header('Location: home.php');
	}

?>