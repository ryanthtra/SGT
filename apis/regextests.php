<?php

function testValidGrade($grade)
{
	return preg_match('/^100$|^[1-9]?[0-9]$/', $grade);
}

function testValidName($name)
{
	return preg_match('/^[a-zA-Z\- ]{2,32}$/', $name);
}

function testValidCourse($course)
{
	return preg_match('/^[a-zA-Z\- 0-9]{2,32}$/', $course);
}

?>