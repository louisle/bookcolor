<?php
class Theme extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }

  public function get($query, $sort){
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select('th');
    $qb = $qb->from('Entity\Theme', 'th');

    if(isset($query['id'])){
      $qb = $qb->where("th.id = :id");
      $qb = $qb->setParameter('id', $query['id']);
    }

    if(isset($query['title'])){
      $qb = $qb->where("th.title LIKE :title");
      $qb = $qb->setParameter('title', '%' . $query['title'] . '%');
    }

    foreach ($sort as $key => $value) {
      $qb = $qb->orderBy('th.'.$key, $value);
    }

    return $qb->getQuery()->getResult();
  }

  public function count($query){
    
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select($qb->expr()->count('th.id'));
    $qb = $qb->from('Entity\Theme', 'th');
    $qb = $qb->where("th.title LIKE :title");

    $qb = $qb->setParameter('title', '%' . $query['title'] . '%');

    return $qb->getQuery()->getSingleScalarResult();
  }


  public function add($theme){
    $this->em->persist($theme);
    $this->em->flush();
  }

  public function edit($theme){
    $theme->update_at = time();
    $this->em->merge($theme);
    $this->em->flush();
  }

  public function remove($id){
    $themes = $this->get(array('id'=>$id), array(), 1, 1);
    if(count($themes) === 1){
      $this->em->remove($themes[0]);
      $this->em->flush();
    }
  }
}