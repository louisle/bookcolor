<?php
class Article extends CI_Model{
  function __contruct(){
    parent::__contruct();
  }

  public function get($query, $sort, $page, $limit){
    $qb =  $this->em->createQueryBuilder();
    $qb = $qb->select('a');
    $qb = $qb->from('Entity\Article', 'a');

    if(isset($query['id'])){
      $qb = $qb->where("a.id = :id");
      $qb = $qb->setParameter('id', $query['id']);
    }

    if(isset($query['title'])){
      $qb = $qb->where("a.title LIKE :title");
      $qb = $qb->setParameter('title', '%' . $query['title'] . '%');
    }

    foreach ($sort as $key => $value) {
      $qb = $qb->orderBy('a.'.$key, $value);
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
    $qb = $qb->select($qb->expr()->count('a.id'));
    $qb = $qb->from('Entity\Article', 'a');
    $qb = $qb->where("a.title LIKE :title");

    $qb = $qb->setParameter('title', '%' . $query['title'] . '%');

    return $qb->getQuery()->getSingleScalarResult();
  }


  public function add($article){
    $this->em->persist($article);
    $this->em->flush();
  }

  public function edit($article){
    $article->update_at = time();
    $this->em->merge($article);
    $this->em->flush();
  }

  public function remove($id){
    $articles = $this->get(array('id'=>$id), array(), 1, 1);
    if(count($articles) === 1){
      $this->em->remove($articles[0]);
      $this->em->flush();
    }
  }
}