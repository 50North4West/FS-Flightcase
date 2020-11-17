<?php

function custom_echo($content, $length, $url)
{
  if(strlen($content) <= $length) {
    return $content;
  }
  else
  {
    $trimmedContent = substr($content, 0, $length).'... <a href="'.$url.'">read more</a>';
    return $trimmedContent;
  }
}

function shortenEcho($content, $length)
{
  if(strlen($content) <= $length) {
    return $content;
  }
  else
  {
    $trimmedContent = substr($content, 0, $length).'...';
    return $trimmedContent;
  }
}
