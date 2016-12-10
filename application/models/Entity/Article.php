<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Article Model
 *
 * @Entity
 * @table(name="cf_article")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Article extends Base{
  /**
   * @ManyToMany(targetEntity="Blog", inversedBy="articles", cascade={"persist"})
   * @JoinTable(name="cf_article_blog",
   * joinColumns={@JoinColumn(name="article_id", referencedColumnName="id")},
   * inverseJoinColumns={@JoinColumn(name="blog_id", referencedColumnName="id")}
   * )
   */
  public $blogs;

  /**
   * @Column(type="string", length=128)
   */
  public $url;

  /**
   * @Column(type="string", length=128)
   */
  public $title;


  /**
   * @Column(type="text", length=4096)
   */
  public $content;
  
  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 0;

  /**
   * @ManyToMany(targetEntity="Tag", mappedBy="articles", cascade={"persist"})
   */
  public $tags = [];

  public $type = 'ARTICLE';

  public function getAdminPath(){
    return "/admin/articles/edit?id=".$this->id;
  }

  public function getStatusTpl(){
    switch ($this->status) {
      case 0:
        return "<button class='btn btn-warning btn-xs'>Ẩn</button>";
        break;

      case 1:
        return "<button class='btn btn-primary btn-xs'>Hiện</button>";
        break;
      
      default:
        # code...
        break;
    }
  }
}
?>