<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Link Model
 *
 * @Entity
 * @table(name="cf_link")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Link extends Base{

  /**
   * @OneToMany(targetEntity="Link", mappedBy="parent")
   */
  public $childrens;

  /**
   * @ManyToOne(targetEntity="Link", inversedBy="children")
   * @JoinColumn(name="parent_id", referencedColumnName="id")
   */
  public $parent;

  /**
   * @Column(type="string", length=128)
   */
  public $title;

  /**
   * @Column(type="string", length=128)
   */
  public $target_type = NULL;

  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 1;
  
  /**
   * @Column(type="integer")
   */
  public $target_id = FALSE;

  public $type = 'LINK';

  public $targetObject = NULL;

  public $object = FALSE;

  function __construct()
  {
      parent::__construct();
      $this->childrens = new ArrayCollection();
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

  public function getAdminPath(){
    return $this->id == 0 ? '/admin/links' : '/admin/links?parent='.$this->id;
  }


}
?>