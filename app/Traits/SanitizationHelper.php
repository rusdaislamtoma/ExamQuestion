<?php
namespace App\Traits;

trait SanitizationHelper{

	public function sanitize($input)
	{
		$input = htmlspecialchars($input);
		$input = strip_tags($input);
		$input = trim($input,'');
	    return $input;
	}
}