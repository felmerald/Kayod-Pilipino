<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*   Class Name  :   Excel
*   Location    :   liraries/excel.php
*   @author     :   Fel
*   @access     private
*   Description : export file to excel
*/ 
require_once APPPATH .'/third_party/PHPExcel.php';
class Excel extends PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }
}
