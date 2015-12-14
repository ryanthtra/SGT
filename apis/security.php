<?php

function makeSafeString($str)
{
	return addslashes(htmlentities(trim($str)));
}

function makeSafeInt($expr)
{
	return (int)$expr;
}
?>