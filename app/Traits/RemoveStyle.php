<?php
namespace App\Traits;

trait RemoveStyle{

	public function remove_style($input)
	{
		$input = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $input);
	    return $input;
	}
}