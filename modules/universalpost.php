<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/universalpost/process.php";
}else{
	include "modules/universalpost/index.php";
}
?>