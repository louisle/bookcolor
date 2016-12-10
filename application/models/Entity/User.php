<?php

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Entity\BaseEntity as Base;

/**
 * User Model
 *
 * @Entity
 * @Table(name="cf_user")
 * @author  Vu Le Hoang <hoangvu171819@gmail.com>
 */
class User extends Base
{

	/**
	 * @Column(type="string", length=32, unique=true, nullable=false)
	 */
	public $username;

	/**
	 * @Column(type="string", length=64, nullable=false)
	 */
	public $password;

	/**
	 * @Column(type="string", length=255, unique=true, nullable=false)
	 */
	public $email;

	/**
	 * @Column(type="string", length=255, nullable=true)
	 */
	public $avatar;

	/**
	 * @Column(type="string", length=255, nullable=true)
	 */
	public $address;

	/**
	 * @Column(type="integer", nullable=false)
	 */
	public $type;
  
	/**
	* @Column(type="integer", nullable=true)
	*/
	public $status = 1;

}
