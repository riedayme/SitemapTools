<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/universaldeep/process.php";
}else{
	include "modules/universaldeep/index.php";
}
?>