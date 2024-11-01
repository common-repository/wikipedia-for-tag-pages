<?php

function get_wiki($lang, $limit) {
		$query = str_replace(" ", "-", strtolower(single_tag_title("", false)));
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://". $lang . ".wikipedia.org/w/api.php?format=xml&maxage=600&smaxage=1200&action=opensearch&search=" . $query . "&limit=". $limit ."");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,70);
		curl_setopt($ch,CURLOPT_USERAGENT,"wikipedia for tag pages widget");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
		$data = curl_exec($ch);	
		$xml = simplexml_load_string($data);
		return $xml;
	}
	
	function lev_sort($input, $words) {
		// no shortest distance found, yet
		$shortest = -1;
		// loop through words to find the closest
		foreach ($words as $word) {
			// calculate the distance between the input word,
			// and the current word
			$lev = levenshtein($input, $word->Section->Item[0]->Text);
			// check for an exact match
			if ($lev == 0) {
				// closest word is this one (exact match)
				$closest = $word;
				$shortest = 0;
				// break out of the loop; we've found an exact match
				break;
			}
			// if this distance is less than the next found shortest
			// distance, OR if a next shortest word has not yet been found
			if ($lev <= $shortest || $shortest < 0) {
				// set the closest match, and shortest distance
				$closest  = $word;
				$shortest = $lev;
			}
		}
		return $closest;
	}
?>