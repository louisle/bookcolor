<?php
class Blog extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }

  public function get($query, $sort, $page, $limit){
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select('b');
    $qb = $qb->from('Entity\Blog', 'b');

    if(isset($query['id'])){
      if(is_array($query['id'])){
        $qb = $qb->where("b.id IN (:ids)");
        $qb = $qb->setParameter('ids', $query['id']);
      }else{
        $qb = $qb->where("b.id = :id");
        $qb = $qb->setParameter('id', $query['id']);
      }
    }

    if(isset($query['title'])){
      $qb = $qb->where("b.title LIKE :title");
      $qb = $qb->setParameter('title', '%' . $query['title'] . '%');
    }

    foreach ($sort as $key => $value) {
      $qb = $qb->orderBy('b.'.$key, $value);
    }

    if($page == -1 || $limit == -1){

    }else{
      $qb = $qb->setFirstResult((int)(($page - 1) * $limit)); 
      $qb = $qb->setMaxResults((int)$limit);
    }

    return $qb->getQuery()->getResult();
  }

  public function count($query){
    
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select($qb->expr()->count('b.id'));
    $qb = $qb->from('Entity\Blog', 'b');
    if(isset($query['title'])){
      $qb = $qb->where("b.title LIKE :title");
      $qb = $qb->setParameter('title', '%' . $query['title'] . '%');
    }

    return $qb->getQuery()->getSingleScalarResult();
  }

  public function add($blog){
    $this->em->persist($blog);
    $this->em->flush();
  }

  public function edit($blog){
    $blog->update_at = time();
    $this->em->merge($blog);
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