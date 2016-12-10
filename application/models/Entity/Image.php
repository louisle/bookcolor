<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Image Model
 *
 * @Entity
 * @table(name="cf_image")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Image extends Base{

  /**
   * @ManyToOne(targetEntity="Product", inversedBy="images")
   * @JoinColumn(name="product_id", referencedColumnName="id")
   */
  public $product;

  /**
   * @Column(type="string", length=128)
   */
  public $path;

  /**
   * @Column(type="string", length=128)
   */
  public $alt;

  /**
   * @Column(type="integer")
   */
  public $width;

  /**
   * @Column(type="integer")
   */
  public $height;

  /**
   * @Column(type="integer")
   */
  public $size;
}
?>