<?php 
/**
*   Class name : time ago library
*   Description : convert datetime to time
*   @param : NULL
*   @return: Time
*   @author:Felmerald
*   @access public
*
*/ 
if(!defined('BASEPATH')) exit('No direct script access allowed');
	
class Time_ago_lib{

    public function __construct()
    {
        $this->CI =& get_instance();
    }   
		/**
		* @param $timestamp return time
		*/ 
	function time_ago($timestamp) 
	{

    $output = ""; //string value to be returned
    $now = time();
    $createtime = strtotime($timestamp); //mysqli timestamp 
    $difference = abs($now - $createtime);

    $years = floor($difference / (365*60*60*24));
    $months = floor(($difference-$years*365*60*60*24)/(30*60*60*24));
    $days = floor(($difference - $years*365*60*60*24-$months*30*60*60*24)/(60*60*24));
    $hours = floor($difference / 3600);
    $minutes = floor($difference / 60);
    $seconds = floor($difference);


    if ($output == "") 
    {   //to check whether it is years old
        if ($years > 1) 
        {
            $output = $years . " years ago";
        }
         elseif ($years == 1) 
        {
            $output = $years . " year ago";
        }
    }

    if ($output == "") 
    {   //to check whether it is months old
        if ($months > 1)
        {
            $output = $months . " months ago";
        }
         elseif ($months == 1) 
        {
            $output = $months . " month ago";
        }
    }

    if ($output == "") 
    {   //to check whether it is days old
        if ($days > 1) 
        {
            $output = $days . " days ago";
        } 
        elseif ($days == 1) 
        {
            $output = $days . " day ago";
        }
    }

    if ($output == "") 
    {   //to check whether it is hours old
        if ($hours > 1) 
        {
            $output = $hours . " hours ago";
        }
         elseif ($hours == 1) 
        {
            $output = $hours . " hour ago";
        }
    }
     
    if ($output == "") 
    {   //to check whether it is minutes old
        if ($minutes > 1) 
        {
            $output = $minutes . " minutes ago";
        }
         elseif ($minutes == 1) 
        {
            $output = $minutes . " minute ago";
        }
    }
    
    if ($output == "") 
    {   //to check whether it is seconds old
        if ($seconds > 1) 
        {
            $output = $seconds . " seconds ago";
        }
        elseif ($seconds == 1) 
       	{
            $output = $seconds . " second ago";
        }
    }
    return $output;
}


}

?>