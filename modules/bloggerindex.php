<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/bloggerindex/process.php";
}else{
	include "modules/bloggerindex/index.php";
}
?>