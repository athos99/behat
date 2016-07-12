<?php

function curl_get($url,  array $options = array())
{
  $defaults = array(
    CURLOPT_URL => $url,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_TIMEOUT => 4
  );

  $ch = curl_init();
  curl_setopt_array($ch, ($options + $defaults));
  if( ! $result = curl_exec($ch))
  {
    trigger_error(curl_error($ch));
  }
  curl_close($ch);
  return $result;
}

$c=curl_get('http://127.0.0.1/');
echo $c;