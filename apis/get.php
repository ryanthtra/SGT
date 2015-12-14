<?php

//******* MAIN CODE BELOW *******//
$api_key = $_POST['api_key'];
$output = 
	[
		'success'=>false,
		'errors'=>array(),
		'data'=>array()
	];

if (!hasReadAccess($api_key)) 
{
    array_push($output['errors'], "Invalid/missing API key!");
    print(json_encode($output));
}
else
{
	$output = getEntries();
	print(json_encode($output));
}
//******* END MAIN CODE *******//

function hasReadAccess($api_key)
{
	require("mysql_connect.php");
	$READ_ACCESS = 1;
	$query = "SELECT `rights_flags` FROM `api_keys` WHERE api_key='" . $api_key . "'";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			if ($row['rights_flags'] & $READ_ACCESS != 0)
				return true;
		}
	}

	return false;
}

function getEntries()
{
	require("mysql_connect.php");
	$output = 
	[
		'success'=>false,
		'errors'=>array(),
		'data'=>array()
	];
	$query = 
	    "SELECT students.name, courses.course, sgt.grade, sgt.id
	    FROM students, courses, sgt
	    WHERE sgt.student_id=students.id AND sgt.course_id=courses.id
	    ORDER BY sgt.id ASC";

	//$query =
	//    "SELECT s.name, c.course, sgt.grade 
	//    FROM sgt 
	//    JOIN students AS s ON sgt.student_id=s.id 
	//    JOIN courses AS c ON sgt.course_id=c.id
	//    ORDER BY sgt.id ASC";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		$output['success'] = true;
		while ($row = mysqli_fetch_assoc($result))
		{
			array_push($output['data'], $row);
		}
		return $output;
	}
	else
	{
		$output['success'] = true;
		return $output;
	}
}
?>