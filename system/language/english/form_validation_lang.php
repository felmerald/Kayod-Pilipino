<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '<span class="label label-danger">The {field} field is required.</span>';
$lang['form_validation_isset']			= '<span class="label label-danger">The {field} field must have a value.</span>';
$lang['form_validation_valid_email']	= '<span class="label label-danger">The {field} field must contain a valid email address.</span>';
$lang['form_validation_valid_emails']	= '<span class="label label-danger">The {field} field must contain all valid email addresses.</span>';
$lang['form_validation_valid_url']		= '<span class="label label-danger">The {field} field must contain a valid URL.</span>';
$lang['form_validation_valid_ip']		= '<span class="label label-danger">The {field} field must contain a valid IP.</span>';
$lang['form_validation_min_length']		= '<span class="label label-danger">The {field} field must be at least {param} characters in length.</span>';
$lang['form_validation_max_length']		= '<span class="label label-danger">The {field} field cannot exceed {param} characters in length.</span>';
$lang['form_validation_exact_length']   = '<span class="label label-danger">The {field} field must be exactly {param} characters in length.</span>';
$lang['form_validation_alpha']			= '<span class="label label-danger">The {field} field may only contain alphabetical characters.</span>';
$lang['form_validation_alpha_numeric']	= '<span class="label label-danger">The {field} field may only contain alpha-numeric characters.</span>';
$lang['form_validation_alpha_numeric_spaces']	= '<span class="label label-danger">The {field} field may only contain alpha-numeric characters and spaces.</span>';
$lang['form_validation_alpha_dash']		= '<span class="label label-danger">The {field} field may only contain alpha-numeric characters, underscores, and dashes.</span>';
$lang['form_validation_numeric']		= '<span class="label label-danger">The {field} field must contain only numbers.</span>';
$lang['form_validation_is_numeric']		= '<span class="label label-danger">The {field} field must contain only numeric characters.</span>';
$lang['form_validation_integer']		= '<span class="label label-danger">The {field} field must contain an integer.</span>';
$lang['form_validation_regex_match']	= '<span class="label label-danger">The {field} field is not in the correct format.</span>';
$lang['form_validation_matches']		= '<span class="label label-danger">The {field} field does not match the {param} field.</span>';
$lang['form_validation_differs']		= '<span class="label label-danger">The {field} field must differ from the {param} field.</span>';
$lang['form_validation_is_unique'] 		= '<span class="label label-danger">The {field} is already register please use another email.</span>';
$lang['form_validation_is_natural']		= '<span class="label label-danger">The {field} field must only contain digits.</span>';
$lang['form_validation_is_natural_no_zero']	= '<span class="label label-danger">The {field} field must only contain digits and must be greater than zero.</span>';
$lang['form_validation_decimal']		= '<span class="label label-danger">The {field} field must contain a decimal number.</span>';
$lang['form_validation_less_than']		= '<span class="label label-danger">The {field} field must contain a number less than {param}.</span>';
$lang['form_validation_less_than_equal_to']	= '<span class="label label-danger">The {field} field must contain a number less than or equal to {param}.</span>';
$lang['form_validation_greater_than']		= '<span class="label label-danger">The {field} field must contain a number greater than {param}.</span>';
$lang['form_validation_greater_than_equal_to']	= '<span class="label label-danger">The {field} field must contain a number greater than or equal to {param}.</span>';
$lang['form_validation_error_message_not_set']	= '<span class="label label-danger">Unable to access an error message corresponding to your field name {field}.</span>';
$lang['form_validation_in_list']		= '<span class="label label-danger">The {field} field must be one of: {param}.</span>';
