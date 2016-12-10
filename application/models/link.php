<?php
class Link extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }
  
  CONST BLOG_TYPE = 1;
  CONST ARTICLE_TYPE = 2;

  public function get($query, $sort, $page, $limit){
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select('l');
    $qb = $qb->from('Entity\Link', 'l');

    if(isset($query['id'])){
      if(is_array($query['id'])){
        $qb = $qb->where("l.id IN (:ids)");
        $qb = $qb->setParameter('ids', $query['id']);
      }else{
        $qb = $qb->where("l.id = :id");
        $qb = $qb->setParameter('id', $query['id']);
      }
    }

    if(isset($query['parent'])){
      $qb = $qb->where("l.parent = :parent");
      $qb = $qb->setParameter('parent', $query['parent']);
    }
    foreach ($sort as $key => $value) {
      $qb = $qb->orderBy('l.'.$key, $value);
    }

    if($page == -1 || $limit == -1){

    }else{
      $qb = $qb->setFirstResult((int)(($page - 1) * $limit)); 
      $qb = $qb->setMaxResults((int)$limit);
    }

    $results = $qb->getQuery()->getResult();

    for ($i=0; $i < count($results); $i++) { 
      switch ($results[$i]->target_type) {
        case 'ARTICLE':
          $results[$i]->targetObject = $this->em->getRepository('Entity\Article')->find($results[$i]->target_id);
          break;

        case 'BLOG':
          $results[$i]->targetObject = $this->em->getRepository('Entity\Blog')->find($results[$i]->target_id);
          break;
        
        default:
          $results[$i]->targetObject = NULL;
          break;
      }

    }
    return $results;
  }

  public function count($query){
    
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select($qb->expr()->count('l.id'));
    $qb = $qb->from('Entity\link', 'l');


    if(isset($query['id'])){
      if(is_array($query['id'])){
        $qb = $qb->where("l.id IN (:ids)");
        $qb = $qb->setParameter('ids', $query['id']);
      }else{
        $qb = $qb->where("l.id = :id");
        $qb = $qb->setParameter('id', $query['id']);
      }
    }

    if(isset($query['parent'])){
      $qb = $qb->where("l.parent = :parent");
      $qb = $qb->setParameter('parent', $query['parent']);
    }

    return $qb->getQuery()->getSingleScalarResult();
  }

  public function add($link){
    $this->em->persist($link);
    $this->em->flush();
  }

  public function edit($link){
    $link->update_at = time();
    $this->em->merge($link);
    $this->em->flush();
  }

  public function remove($id){
    $blogs = $this->get(array('id'=>$id), array(), 1, 1);
    if(count($blogs) === 1){
      echo $blogs[0]->title;
      $this->em->remove($blogs[0]);
      $this->em->flush();
    }
  }
}
