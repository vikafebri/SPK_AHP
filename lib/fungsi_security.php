<?php
function anti_injection($d)
{
	$f=(stripslashes(strip_tags(htmlspecialchars($d, ENT_QUOTES))));
	return $f;
}
?>