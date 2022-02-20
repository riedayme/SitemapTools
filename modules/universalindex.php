<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/universalindex/process.php";
}else{
	include "modules/universalindex/index.php";
}
?>