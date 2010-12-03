<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Sebastian Michaelsen <sebastian.gebhard@googlemail.com>
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Store
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Jobsearch_Domain_Model_Store extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * address
	 * @var string
	 */
	protected $address;
	
	/**
	 * city
	 * @var string
	 */
	protected $city;
	
	/**
	 * contactPerson
	 * @var string
	 */
	protected $contactPerson;
	
	/**
	 * country
	 * @var string
	 */
	protected $country;
	
	/**
	 * email
	 * @var string
	 */
	protected $email;
	
	/**
	 * fax
	 * @var string
	 */
	protected $fax;
	
	/**
	 * name
	 * @var string
	 */
	protected $name;
	
	/**
	 * phone
	 * @var string
	 */
	protected $phone;
	
	/**
	 * zip
	 * @var string
	 */
	protected $zip;

	/**
	 * lat
	 * @var float
	 */
	protected $lat;

	/**
	 * lon
	 * @var float
	 */
	protected $lon;
	
	/**
	 * Setter for address
	 *
	 * @param string $address address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Getter for address
	 *
	 * @return string address
	 */
	public function getAddress() {
		return $this->address;
	}
	
	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for zip
	 *
	 * @param string $zip zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Getter for zip
	 *
	 * @return string zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Setter for lat
	 *
	 * @param float $lat lat
	 * @return void
	 */
	public function setLat($lat) {
		$this->lat = $lat;
	}

	/**
	 * Getter for lat
	 *
	 * @return string lat
	 */
	public function getLat() {
		return $this->lat;
	}

	/**
	 * Setter for lon
	 *
	 * @param string $lon lon
	 * @return void
	 */
	public function setLon($lon) {
		$this->lon = $lon;
	}

	/**
	 * Getter for lon
	 *
	 * @return string lon
	 */
	public function getLon() {
		return $this->lon;
	}
	
	/**
	 * Setter for country
	 *
	 * @param string $country country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Getter for country
	 *
	 * @return string country
	 */
	public function getCountry() {
		return $this->country;
	}
	
	/**
	 * Setter for city
	 *
	 * @param string $city city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Getter for city
	 *
	 * @return string city
	 */
	public function getCity() {
		return $this->city;
	}
	
	/**
	 * Setter for contactPerson
	 *
	 * @param string $contactPerson contactPerson
	 * @return void
	 */
	public function setContactPerson($contactPerson) {
		$this->contactPerson = $contactPerson;
	}

	/**
	 * Getter for contactPerson
	 *
	 * @return string contactPerson
	 */
	public function getContactPerson() {
		return $this->contactPerson;
	}
	
	/**
	 * Setter for email
	 *
	 * @param string $email email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Getter for email
	 *
	 * @return string email
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Setter for phone
	 *
	 * @param string $phone phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Getter for phone
	 *
	 * @return string phone
	 */
	public function getPhone() {
		return $this->phone;
	}
	
	/**
	 * Setter for fax
	 *
	 * @param string $fax fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Getter for fax
	 *
	 * @return string fax
	 */
	public function getFax() {
		return $this->fax;
	}
	
}
?>