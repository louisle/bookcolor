<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Theme Model
 *
 * @Entity
 * @table(name="cf_theme")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Theme extends Base{
  /**
   * @Column(type="text", length=4096)
   */
  public $name;

  /**
   * @Column(type="text", length=4096)
   */
  public $directory;

  /**
   * @Column(type="text", length=4096)
   */
  public $description;

  /**
   * @Column(type="text", length=4096)
   */
  public $default_title;

  /**
   * @Column(type="text", length=4096)
   */
  public $default_description;

  /**
   * @Column(type="integer", nullable=true)
   */
  public $status = 0;

  /**
   * @OneToMany(targetEntity="Site", mappedBy="theme")
   */
  public $sites;
}
?>