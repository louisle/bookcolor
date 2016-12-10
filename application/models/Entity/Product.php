<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Product Model
 *
 * @Entity
 * @table(name="cf_product")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Product extends Base{
  /**
   * @ManyToMany(targetEntity="Category", inversedBy="products", cascade={"persist"})
   * @JoinTable(name="product_category",
   * joinColumns={@JoinColumn(name="product_id", referencedColumnName="id")},
   * inverseJoinColumns={@JoinColumn(name="category_id", referencedColumnName="id")}
   * )
   */
  public $categories;

  /**
   * @Column(type="string", length=128)
   */
  public $url;
  /**
   * @Column(type="string", length=128)
   */
  public $title;

  /**
   * @Column(type="string", length=4096)
   */
  public $content;

  /**
   * @Column(type="integer")
   */
  public $price;
  
  /**
   * @Column(type="integer")
   */
  public $compare_price;

  /**
   * @Column(type="integer")
   */
  public $inventory;

  /**
   * @OneToMany(targetEntity="Image", mappedBy="product")
   */
  public $images;
  
  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 1;

}
?>