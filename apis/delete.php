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
if (!$creator_id) 
{
    array_push($output['errors'], "Invalid/missing API key!");
}
else
{
	$entry_id = $_POST['student_id'];
	$output = deleteRow($entry_id);
}
print(json_encode($output));
//******* END MAIN CODE *******//


//******* CUSTOM FUNCTIONS BELOW*******//
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
				return true;
		}
	}

	return false;
}

function deleteRow($entry_id)
{
	require("mysql_connect.php");
	$return_obj = 
		[
			'success'=>false,
			'errors'=>array(),
		];
	$query = 
		"DELETE FROM sgt
		WHERE id='" . $entry_id ."'";

	$result = mysqli_query($conn, $query);
	if ($result && mysqli_affected_rows($conn) > 0)
	{
		$return_obj['success'] = true;
	}
	else
	{
		array_push($return_obj['errors'], "Something wrong happened when trying to delete the entry!");
	}

	return $return_obj;
}
?>