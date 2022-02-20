<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/bloggerpost/process.php";
}else{
	include "modules/bloggerpost/index.php";
}
?>