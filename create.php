<?php

//******* MAIN CODE BELOW *******//
$api_key = $_POST['api_key'];
$output = 
	[
		'success'=>false,
		'errors'=>array(),
		'new_id'=>-1
	];

$creator_id = hasWriteAccess($api_key);
if ($creator_id < 0) 
{
    array_push($output['errors'], "Invalid/missing API key!");
}
else
{
	$course = $_POST['course'];
	$course_id = getCourseId($course);
	if ($course_id < 0)
		array_push($output['errors'], "Course doesn't exist!");

	// TODO: check for multiple students with the same name
	$student = $_POST['name'];
	$student_id = getStudentId($student);
	if ($student_id < 0)
		array_push($output['errors'], "Student doesn't exist!");

	$grade = $_POST['grade'];
	if (!testValidGrade($grade))
		array_push($output['errors'], "Please enter a grade between 0 and 100.");

	// If we had no errors to this point, then add the entry to the SGT.
	if (empty($output['errors'])) 
	{
		$output = addSGTEntry($creator_id, $student_id, $course_id, $grade);
	}
}
print(json_encode($output));
//******* END MAIN CODE *******//

function hasWriteAccess($api_key)
{
	require("mysql_connect.php");
	$WRITE_ACCESS = 2;
	$query = "SELECT `rights_flags`, `id` FROM `api_keys` WHERE api_key='" . $api_key . "'";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$mask = intval($row['rights_flags']) & $WRITE_ACCESS;
			if ($mask != 0)
				return $row['id'];
		}
	}

	return -1;
}

function getCourseId($course_name)
{
	require("mysql_connect.php");

	$query = "SELECT id FROM courses WHERE course='" . $course_name . "'";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			return $row['id'];
		}
	}
	else
	{
		// Course doesn't exist in the courses table.
		return -1;
	}
}

function getStudentId($student_name)
{
	require("mysql_connect.php");

	$query = "SELECT id FROM students WHERE name='" . $student_name . "'";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			return $row['id'];
		}
	}
	else
	{
		// Student doesn't exist in the student table.
		return -1;
	}
}

function testValidGrade($grade)
{
	return ($grade >= 0 && $grade <= 100);
}

function addSGTEntry($creator_id, $student_id, $course_id, $grade)
{
	require("mysql_connect.php");
	$return_obj = 
		[
			'success'=>false,
			'errors'=>array(),
			'new_id'=>-1
		];

	$query = 
		"INSERT INTO sgt (id, creator_id, student_id, course_id, grade, timestamp)
		VALUES (NULL, '" . $creator_id . "', '" . $student_id . "', '" . $course_id . "', '" . $grade . "', NOW())";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_affected_rows($conn) > 0)
	{
		$new_id = mysqli_insert_id($conn);
		$return_obj['success'] = true;
		$return_obj['new_id'] = $new_id;
	}
	else
	{
		array_push($return_obj['errors'], "Something wrong happened when trying to add the new entry!");
	}

	return $return_obj;
}

?>