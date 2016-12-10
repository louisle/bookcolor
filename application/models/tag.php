<?php
class Tag extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }
  public function get($query, $sort, $page, $limit){
    if($page == -1 || $limit == -1){
      return $this->em->getRepository('Entity\Tag')
        ->findBy($query);
    }
  	return $this->em->getRepository('Entity\Tag')
  	 ->findBy($query, $sort, $limit, $limit * ($page - 1));
  }

  public function add($tag){
    $this->em->persist($tag);
    $this->em->flush();
  }

  public function edit($tag){
    $tag->update_at = time();
    $this->em->merge($tag);
    $this->em->flush();
  }

  public function remove($id){
    $tags = $this->get(array('id'=>$id), array(), 1, 1);
    if(count($tags) === 1){
      $this->em->remove($tags[0]);
      $this->em->flush();
    }
  }
}