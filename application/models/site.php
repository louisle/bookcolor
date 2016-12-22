<?php
class Site extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }
  public function getOne($domain){
  	$result = $this->em->getRepository('Entity\Site')
  	 ->findBy(array('domain'=>$domain));
     return !empty($result)?$result[0]:FALSE;
  }
}