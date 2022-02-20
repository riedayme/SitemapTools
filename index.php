<?php define('BASEPATH', true); // protect script from direct access

require "includes/helper.php";
require "includes/config.php";

switch (@$_GET['module']) {	

	case 'universaldeep':
	include "modules/universaldeep.php";
	break;	

	case 'universalindex':
	include "modules/universalindex.php";
	break;	

	case 'universalpost':
	include "modules/universalpost.php";
	break;	

	case 'bloggerindex':
	include "modules/bloggerindex.php";
	break;	

	case 'bloggerpost':
	include "modules/bloggerpost.php";
	break;	

	default:
	include "modules/dashboard.php";
	break;
}
?>