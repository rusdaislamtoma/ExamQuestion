<?php
namespace App\Traits;

trait RemoveHtmlTag
{

	public function remove_style($input)
	{
		// ----- remove HTML TAGs ----- 
		$input = preg_replace ('/<[^>]*>/', ' ', $input);

    	// ----- remove control characters ----- 
    $input = str_replace("\r", '', $input);    // --- replace with empty space
    $input = str_replace("\t", ' ', $input);   // --- replace with space
    
    // ----- remove multiple spaces ----- 
    $input = trim(preg_replace('/ {2,}/', ' ', $input));
    
    return $input; 
}

}