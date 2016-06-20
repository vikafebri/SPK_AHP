<?php

require_once("twitteroauth-master/twitteroauth/twitteroauth.php");
	
	
define('CONSUMER_KEY', '4Zhtwen0G6WvbGY8sYdjA');
define('CONSUMER_SECRET', 'Ny9114gDY6e7Re1GjlatyXz5rweVU4kX9wjWT918');
define('ACCESS_TOKEN', '96719541-W0X8rNL2mz7V42bLeXUJD6Ux0U1SKMKyQStctcCTs');
define('ACCESS_TOKEN_SECRET', 'XXitYM1w4DssMpVj4tJLgVlHP76huu2XAYEtxSO2YYmqW');


function search(array $query)
{
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $toa->get('search/tweets', $query);
}


 function grabtweet($queryy)
{
	$results = search($queryy);
	$date_format         = 'm.d.y';
	$simpantweet = array(); 
	$no=0;
	foreach ($results->statuses as $result) {
	$no++;
					$tweet_time = strtotime($result->created_at);	
					$display_time = date($date_format,$tweet_time);

					$tweet_desc = $result->text;
					
						
					$simpantweet[$result->user->screen_name]['waktu']=$display_time;		
					$simpantweet[$result->user->screen_name]['isitweet']=$tweet_desc;		
		
	}

	return $simpantweet;
}
?>