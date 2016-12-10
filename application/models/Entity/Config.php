<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;
/**
 * Blog Config
 *
 * @Entity
 * @table(name="cf_config")
 * @author vu le hoang(hoangvu171819@gmail.com)
 */
class Config extends Base{

  /**
   * @Column(type="string", length=128)
   */
  public $website_name;

	public function __construct(){
    parent::__construct();
	}

}
?>