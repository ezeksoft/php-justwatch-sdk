<?php 

namespace Ezeksoft\JustWatchSDK;

class SDK
{
	public String $endpoint = 'https://apis.justwatch.com';

	public function request_locales($country)
	{
		$json = file_get_contents("{$this->endpoint}/content/locales/state");
		$array = json_decode($json);

		$locale = '';

		foreach ($array as $result)
		{
			if ($result->iso_3166_2 == $country || $result->country == $country)
				$locale = $result->full_locale;
		}

		return $locale;
	}

	public function set_locale($country)
	{
		$this->locale = $this->request_locales($country);
	}

	public function search_title($search, $type=null)
	{
		$content_types = $type ? [$type] : null;

		$result = '';

		try
		{
			$payload = [
				"query" => $search,
				"age_certifications" => null,
				"content_types" => $content_types,
				"presentation_types" => null,
				"providers" => null,
				"genres" => null,
				"languages" => null,
				"release_year_from" => null,
				"release_year_until" => null,
				"monetization_types" => null,
				"min_price" => null,
				"max_price" => null,
				"nationwide_cinema_releases_only" => null,
				"scoring_filter_types" => null,
				"cinema_release" => null,
				"page" => null,
				"page_size" => null,
				"timeline_type" => null,
				"person_id" => null
			];

			$url = "{$this->endpoint}/content/titles/{$this->locale}/popular";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
			$result = curl_exec($curl);
			curl_close($curl);
		}

		catch (Exception $e)
		{
			echo 'Exception: ';
			print_r($e->getMessage());
			die();
		}

		return $result;
	}

	public function get_title($id, $type='movie')
	{
		$url = "{$this->endpoint}/content/titles/$type/$id/locale/{$this->locale}";
		$content = '';
		try
		{
			$content = file_get_contents($url);
		}

		catch (Exception $e)
		{
			echo 'Exception: ';
			print_r($e->getMessage());
			die();
		}

		return $content;
	}

	public function __construct($country='pt_BR')
	{
		$this->set_locale($country);
	}
}