<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Site Model
 *
 * @Entity
 * @table(name="cf_site")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Site extends Base{

  /**
   * @Column(type="text", length=4096)
   */
  public $name;

  /**
   * @Column(type="text", length=4096)
   */
  public $domain;
  
  /**
   * @ManyToOne(targetEntity="Theme", inversedBy="site")
   * @JoinColumn(name="theme_id", referencedColumnName="id")
   */
  public $theme;

  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 0;

}
?>