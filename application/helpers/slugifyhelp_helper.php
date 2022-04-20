<?php 
if(!function_exists('slugify')) {
  function slugify($text, string $divider = '-')
  {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
}
if(!function_exists('escape')) {
  function escape($string) { 
      if(!empty($string) && is_string($string)) { 
      $string = trim($string);
          $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);

          return strip_tags($string);
      }else{
        return $string;
      }
  } 
}

if(!function_exists('back')) {
  function back() { 
      $backs = $_SERVER['HTTP_REFERER'];
      return $backs;
  } 
}

if(!function_exists('unslugify')) {
  function unslugify($str)
  {
    $xpl = str_replace("-", " ", $str);
    $newStr = ucwords($xpl);
    return $newStr;
  }
}