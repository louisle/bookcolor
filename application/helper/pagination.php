<?php
function makePageLink($page, $base_path){
  $sight = "?";
  if(strpos($base_path, "?")){
    $sight = "&";
  }
  return $page > 1 ? $base_path . $sight . "page=$page" : $base_path;
}