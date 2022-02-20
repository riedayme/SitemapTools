<?php 

/**
 * SitemapBlogger
 */
class SitemapBlogger
{

	public function BuildSitemapIndex($url, $type)
	{

		$TotalPost = $this->CountPost($url,$type);
		if ($TotalPost == false)
		{
			return [
			'status' => false,
			'response' => "No sitemap url"
			];
		}
		$TotalSitemapURL = 150;
		$loop = ceil($TotalPost/$TotalSitemapURL);

		if ($type == 'posts') {
			$sitemapname = 'sitemap.xml';
		}else{
			$sitemapname = 'sitemap-pages.xml';
		}

		$BuildSitemap = array();
		if ($TotalPost > 3000) 
		{

			$BuildSitemap[] = $url."sitemap.xml";

			for ($i=1; $i <= $loop ; $i++) 
			{ 

				if ($i <= 20) continue;

				$BuildSitemap[] = $url.$sitemapname."?page=$i";
			}

		}else {
			$BuildSitemap[] = $url.$sitemapname;
		}

		return [
		'status' => true,
		'response' => $BuildSitemap
		];
	}

	/**
	 * Sitemap Post
	 */	
	public function ExtractSitemapPost($SitemapURL)
	{

		if ($SitemapURL == false) 
		{
			return [
			'status' => false,
			'response' => "No sitemap url"
			];
		}

		$PostURL = array();
		foreach ($SitemapURL as $url) 
		{
			$xml = @simplexml_load_file($url); 
			if (!$xml) {
				return [
				'status' => false,
				'response' => "Fail open sitemap"
				];
			}

			foreach($xml->url as $data)
			{
				$PostURL[] = $data->loc;
			}
		}

		if (empty($PostURL)) 
		{
			return [
			'status' => false,
			'response' => "No post found"
			];
		}

		return [
		'status' => true,
		'response' => $PostURL
		];
	}

	public function BuildSitemapPost($url,$type)
	{

		$TotalPost = $this->CountPost($url,$type);
		if ($TotalPost == false) {
			return [
			'status' => false,
			'response' => "No post Found"
			];	
		}
		$TotalSitemapURL = 150;
		$loop = ceil($TotalPost/$TotalSitemapURL);

		if ($type == 'posts') {
			$sitemapname = 'sitemap.xml';
		}else{
			$sitemapname = 'sitemap-pages.xml';
		}

		if ($TotalPost > 150) 
		{

			for ($i=1; $i <= $loop ; $i++) 
			{ 
				$BuildSitemap[] = $url.$sitemapname."?page=$i";
			}

		}else {
			$BuildSitemap[] = $url.$sitemapname;
		}

		return [
		'status' => true,
		'response' => $BuildSitemap
		];
	}

	protected function CountPost($url,$type)
	{

		$prepare_targetURL="{$url}feeds/{$type}/summary?max-results=0";

		$prepare_xml = @simplexml_load_file($prepare_targetURL);	

		if ($prepare_xml) 
		{
			return implode('', $prepare_xml->xpath('openSearch:totalResults'));
		}else {
			return false;
		}

	}
}