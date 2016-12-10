<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Tag Model
 *
 * @Entity
 * @table(name="cf_tag")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Tag extends Base{
  /**
   * @ManyToMany(targetEntity="Article", inversedBy="tags", cascade={"persist"})
   * @JoinTable(name="cf_article_tags",
   * joinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")},
   * inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="id")}
   * )
   */
  public $articles;

  /**
   * @Column(type="string", length=128)
   */
  public $url;
  
  /**
   * @Column(type="string", length=128)
   */
  public $title;

  function __construct(){
    parent::__construct();
    $this->articles = new ArrayCollection();
  }

}
?>