<?php 

$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';

require "library/SitemapUniversal.php";
$sitemap = new SitemapUniversal();

$process = $sitemap->ExtractSitemapDeep($url);

$html = '
<div class="input-style-1">
	<label class="c-field__label">
		Results Post URLs
	</label>
	<textarea onclick="select()" readonly="" name="result" rows="10">'.implode(PHP_EOL, $process).'</textarea>
</div>
';

die(json_encode([
	'status' => true,
	'response' => $html
	]));