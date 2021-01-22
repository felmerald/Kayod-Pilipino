<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kp_library
{
	// convert YYYY/MM/DD to 1996 February 02
	function convert_date_string($date='')
	{

		$user_birthday = $date;
		return date('l jS \of F Y', strtotime($user_birthday));
	}
	// calculate age base on birthday DATE - BIRTHDAY
	function calculate_age($born='')
	{
		$person_birthday = $born;
		return date('Y-m-d') - $person_birthday;
	}

	// generate 11 random integer
	function interger_generator($variable='')
	{
		$var = $variable;
		return $var = random_string('numeric',11);
	}
	


	
}