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
 * JobOffer
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Jobsearch_Domain_Model_JobOffer extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * title
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * amount
	 * @var string
	 */
	protected $amount;

	/**
	 * Job Start date
	 * @var integer
	 */
	protected $jobstart;

	/**
	 * Job endtime
	 * @var integer
	 */
	protected $endtime;
	
	/**
	 * type
	 * @var string
	 */
	protected $type;
	
	/**
	 * description
	 * @var string
	 */
	protected $description;

	/**
	 * requirements
	 * @var string
	 */
	protected $requirements;

	/**
	 * more
	 * @var string
	 */
	protected $more;
	
	/**
	 * store
	 * @var Tx_Jobsearch_Domain_Model_Store
	 */
	protected $store;
	
	
	/**
	 * city
	 * @var string
	 */
	protected $city;
	
	
	/**
	 * channel
	 * @var string
	 */
	protected $channel;
	
	
	/**
	 * Setter for title
	 *
	 * @param string $title title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 *
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Setter for amount
	 *
	 * @param integer $amount amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}

	/**
	 * Getter for amount
	 *
	 * @return integer amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Setter for the job start date
	 *
	 * @param integer $jobstart jobstart
	 * @return void
	 */
	public function setJobstart($jobstart) {
		$this->jobstart = $jobstart;
	}

	/**
	 * Getter for the job start date
	 *
	 * @return integer job start date
	 */
	public function getJobstart() {
		return new DateTime(date('Y-m-d', $this->jobstart));
	}

	/**
	 * Setter for endtime
	 *
	 * @param integer $endtime endtime
	 * @return void
	 */
	public function setEndtime($endtime) {
		$this->endtime = $endtime;
	}

	/**
	 * Getter for endtime
	 *
	 * @return integer endtime
	 */
	public function getEndtime() {
		return new DateTime(date('Y-m-d', $this->endtime));
	}
	
	/**
	 * Setter for type
	 *
	 * @param string $type type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Getter for type
	 *
	 * @return string type
	 */
	public function getType() {
		switch($this->type) {
			case 1:
				return 'Vollzeitstelle';
			case 2:
				return 'Ausbildungsplatz';
		}
	}

	/**
	 * Getter for type
	 *
	 * @return string type
	 */
	public function getTypeNumber() {
		return $this->type;
	}
	
	/**
	 * Setter for description
	 *
	 * @param string $description description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Setter for requirements
	 *
	 * @param string $requirements requirements
	 * @return void
	 */
	public function setRequirements($requirements) {
		$this->requirements = $requirements;
	}

	/**
	 * Getter for requirements
	 *
	 * @return string requirements
	 */
	public function getRequirements() {
		return $this->requirements;
	}

	/**
	 * Setter for more
	 *
	 * @param string $more more
	 * @return void
	 */
	public function setMore($more) {
		$this->more = $more;
	}

	/**
	 * Getter for more
	 *
	 * @return string more
	 */
	public function getMore() {
		return $this->more;
	}
	
	/**
	 * Setter for store
	 *
	 * @param Tx_Jobsearch_Domain_Model_Store $store store
	 * @return void
	 */
	public function setStore(Tx_Jobsearch_Domain_Model_Store $store) {
		$this->store = $store;
		$this->setCity($store->getCity());
	}

	/**
	 * Getter for store
	 *
	 * @return Tx_Jobsearch_Domain_Model_Store store
	 */
	public function getStore() {
		return $this->store;
	}
	
	/**
	 * Setter for city
	 *
	 * @param string $city city
	 * @return void
	 */
	private function setCity($city) {
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
	 * Setter for channel
	 *
	 * @param string $channel channel
	 * @return void
	 */
	private function setChannel($channel) {
		$this->channel = $channel;
	}

	/**
	 * Getter for channel
	 *
	 * @return string channel
	 */
	public function getChannel() {
		return $this->channel;
	}

	public function  __toString() {
		return $this->getTitle();
	}
	
}
?>