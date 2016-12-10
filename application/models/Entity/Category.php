<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Category Model
 *
 * @Entity
 * @table(name="cf_category")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Category extends Base{

  /**
   * @ManyToMany(targetEntity="Product", mappedBy="categories", cascade={"persist"})
   */
  public $products;

  /**
   * @Column(type="string", length=128)
   */
  public $url;
  
  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 1;

  /**
    * @Column(type="integer", nullable=true)
    */
  public $total_product;

  /**
   * @Column(type="string", length=128)
   */
  public $title;

	public function __construct(){
    parent::__construct();
		$this->products = new ArrayCollection();
    $this->total_product = 0;
	}

}
?>