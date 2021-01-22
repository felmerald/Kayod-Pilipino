<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*   Class Name  :   Kayodpilipino_pdf_converter
*   Location    :   liraries/excel.php
*   @author     :   Fel
*   @access     private
*   Description : export file to excel
*/ 
class Kayodpilipino_pdf_converter
{
	/**
	*	public @param;
	*	public $pdf;
	*/ 
	public function __construct()
	{
		 require_once APPPATH.'/third_party/mpdf/mpdf.php';
	}
}