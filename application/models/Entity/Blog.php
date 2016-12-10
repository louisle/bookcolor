<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Blog Model
 *
 * @Entity
 * @table(name="cf_blog")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Blog extends Base{

  /**
   * @ManyToMany(targetEntity="Article", mappedBy="blogs", cascade={"persist"})
   */
  public $articles;
  
  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 0;

  /**
    * @Column(type="integer", nullable=true)
    */
  public $total_article;

  /**
   * @Column(type="string", length=128)
   */
  public $url;

  /**
   * @Column(type="string", length=128)
   */
  public $title;

  public $type = 'BLOG';

  public function getAdminPath(){
    return "/admin/blogs/edit?id=".$this->id;
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

	public function __construct(){
    parent::__construct();
		$this->articles = new ArrayCollection();
    $this->total_article = 0;
	}

}
?>