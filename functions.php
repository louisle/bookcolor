<?php
function makePageLink($page, $base_path){
  return $page > 1 ? $base_path . "?page=$page" : $base_path;
}