<?php 

$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';

require "library/SitemapBlogger.php";
$blogspot = new SitemapBlogger();

$sitemapindex = $blogspot->BuildSitemapPost($url,$_POST['type']);
if (!$sitemapindex['status']) {

	$html = '
	<div class="alert-box danger-alert">
		<div class="alert">
			<p class="text-medium">
				'.$sitemapindex['response'].'
			</p>
		</div>
	</div>
	';	

	die(json_encode([
		'status' => false,
		'response' => $html
		]));
}

$process = $blogspot->ExtractSitemapPost($sitemapindex['response']);
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
		'status' => true,
		'response' => $html
		]));
}

$response = $process['response'];

$html = '
<div class="input-style-1">
	<label class="c-field__label">
		Results Post URLs
	</label>
	<textarea onclick="select()" readonly="" name="result" rows="10">'.implode(PHP_EOL, $response).'</textarea>
</div>
';

die(json_encode([
	'status' => true,
	'response' => $html
	]));