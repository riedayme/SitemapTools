<?php 
header('Content-Type: application/json; charset=utf-8');
$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';


require "library/SitemapBlogger.php";
$blogspot = new SitemapBlogger();

$process = $blogspot->BuildSitemapIndex($url,$_POST['type']);
if (!$process['status']) {

	$html = '
	<div class="alert-box danger-alert">
		<div class="alert">
			<p class="text-medium">
				'.$process['response'].'
			</p>
		</div>
	</div>
	';	

	die(json_encode([
		'status' => false,
		'response' => $html
		]));
}

$response = $process['response'];

$html = '
<div class="input-style-1">
	<label class="c-field__label">
		Results Sitemap URLs
	</label>
	<textarea onclick="select()" readonly="" name="result" rows="10">'.implode(PHP_EOL, $response).'</textarea>
</div>
';

die(json_encode([
	'status' => true,
	'response' => $html
	]));