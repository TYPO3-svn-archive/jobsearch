<?php
/***************************************************************
*  Copyright notice
*
*  (c)  TODO - INSERT COPYRIGHT
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
 * Repository for Tx_Jobsearch_Domain_Model_JobOffer
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Jobsearch_Domain_Repository_JobOfferRepository extends Tx_Extbase_Persistence_Repository {
	
	private $allowedSelectors;
	
	public function __construct() {
		$this->allowedSelectors = array(
			'type', 'city', 'channel'
		);
		parent::__construct();
	}
	
	/**
	 *
	 * @param string $jobTypes Comma-separated list of Job-Types (ids)
	 */
	public function findByJobTypes ($jobTypes) {
		
		$query = $this->createQuery();
		
		/**
		 * // ATTENTION: After you updated this TYPO3 setup to 4.4 or higher please activate the following lines:
		 * 
		 * 
		 * $constraint = $query->in('type', explode(',', $jobTypes));
		 * return $query->matching($constraint)->execute();
		 * 
		 * 
		 * // AND delete all the lines below in this function. This will make this extension future proof for FLOW3!
		 */

		if(t3lib_div::compat_version('4.4')) {

			t3lib_div::deprecationLog('Please have a look at Tx_Jobsearch_Domain_Repository_JobOfferRepository->findByJobTypes()! You\'ll find further instructions.');
			$constraint = $query->in('type', explode(',', $jobTypes));
			$query->matching($constraint);

		} else {

			$where = 'deleted = 0 AND hidden = 0 AND (endtime = 0 OR endtime > ' . time() . ') AND starttime < ' . time();
			$query->statement('SELECT * FROM tx_jobsearch_domain_model_joboffer WHERE ' . $where);

		}

		return $query->execute();
	}

	public function findBySelectorFields() {
		
		$piVars = t3lib_div::_GP('tx_jobsearch_pi1');
		$selectors = $piVars['joboffer'];
		
		$query = $this->createQuery();
		
		$constraint = null;
		foreach($selectors as $selector => $value) {
			if(in_array($selector, $this->allowedSelectors) && $value) {
				if($constraint == null) {
					$constraint = $query->equals($selector, $value);
				} else {
					$constraint = $query->logicalAnd($constraint, $query->equals($selector, $value));
				}
			}
		}
		
		return $query->matching($constraint)->execute();
		
	}

}
?>