<?php
/**
 * SitemapUniversal
 */

require "library/Fetch.php";

class SitemapUniversal extends Fetch
{

	protected $skip = [
	"misc"
	];

	function __construct()
	{
		parent::__construct([
			'fakeuseragent' => true,
			'fakereferer' => true
			]);

		// set unlimit
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		set_time_limit(0);
	}

	/**
	 * Helper
	 */
	protected function RemoveLastSlash($url)
	{
		$checklastcharacter = substr($url, -1);;
		if ($checklastcharacter == '/') {
			$url = substr($url, 0, -1);
		}

		return $url;
	}

	protected function CheckEndURL($url)
	{
		$url = parse_url($url);
		if (empty($url['path'])) {
			return false;
		}
		return $url['path'];
	}

	protected function strpos_extended($haystack, $needle) {
		if(!is_array($needle)) $needle = array($needle);
		foreach($needle as $what) {
			if(($pos = strpos($haystack, $what))!==false) return $pos;
		}
		return false;
	}


	/**
	 * Deep
	 */
	public function ExtractSitemapDeep($url)
	{

		$url = $this->RemoveLastSlash($url);

		$sitemapindex = self::ExtractSitemapIndex($url);

		if (is_array($sitemapindex)) 
		{
			$sitemap = self::ExtractSitemapPost($sitemapindex);
		}else {
			$url = array($url);
			$sitemap = self::ExtractSitemapPost($url);
		}

		return $sitemap;
	}	

	public function ExtractSitemapIndex($url)
	{

		$url = $this->RemoveLastSlash($url);

		$sitemapindex = $this->Fetch($url);
		if (!$sitemapindex) return 'Sitemap URL cannot be opened';		

		libxml_use_internal_errors(true);
		$sitemapindex = simplexml_load_string($sitemapindex);
		if (!$sitemapindex) return 'Sitemap not valid';

		if (property_exists($sitemapindex, 'sitemap')) 
		{
			foreach($sitemapindex as $sitemap)
			{

				// skip
				if ($this->strpos_extended($sitemap->loc, $this->skip)) {
					continue;
				}

				/* filter */
				if ($sitemap->loc) 
				{
					$BuildSitemap[] = (string)$sitemap->loc;
				}
			}
		}else{

			return 'Not sitemap post, try using sitemap index';	
		}

		return $BuildSitemap;
	}

	public function ExtractSitemapPost($urls)
	{

		$post_url = array();
		foreach ($urls as $url) 
		{

			$url = $this->RemoveLastSlash($url);

			$sitemap = $this->Fetch($url);

			if ($sitemap) 
			{
				libxml_use_internal_errors(true);
				$sitemap = simplexml_load_string($sitemap);
				if (@property_exists($sitemap, 'url')) 
				{
					foreach ($sitemap as $post) 
					{

						if ($post->lastmod) 
						{

							/** check if sitemap url not have path  */
							$end_post_url = $this->CheckEndURL($post->loc);
							if ($end_post_url == '/' OR empty($end_post_url)) continue;

							$post_url[] = (string)$post->loc;
						}
					}
				}else{
					$post_url[] = 'Not sitemap post, try using sitemap index';
				}
			}else{
				$post_url[] = 'Sitemap URL cannot be opened : '.$url;
			}
		}

		return $post_url;
	}
}