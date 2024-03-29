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
 * Controller for the JobOffer object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_Jobsearch_Controller_JobOfferController extends Tx_Extbase_MVC_Controller_ActionController {
	
    /**
     * @var Tx_Jobsearch_Domain_Repository_JobOfferRepository
     */
    protected $jobOfferRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->jobOfferRepository = t3lib_div::makeInstance('Tx_Jobsearch_Domain_Repository_JobOfferRepository');
	}
	
	public function indexAction() {
		if($this->settings['typesToShow']) {
			$offers = $this->jobOfferRepository->findByJobTypes($this->settings['typesToShow']);
		} else {
			$offers = $this->jobOfferRepository->findAll();
		}
		$this->view->assign('jobOffers',$offers);
	}
	
	public function ajaxSearchAction() {
		$this->view->assign('jobOffers', $this->jobOfferRepository->findBySelectorFields());
		$content = $this->view->render();
		
		// AJAX
		echo $content;
		die();
	}
	
	/**
	 * Action that displays a single job offer
	 *
	 * @param Tx_Jobsearch_Domain_Model_JobOffer $jobOffer The offer to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_Jobsearch_Domain_Model_JobOffer $jobOffer) {
		$this->view->assign('jobOffer', $jobOffer);
		$this->view->assign('nextDay', $this->getNextDay());
	}

	private function getNextDay() {
		$timestampNextDay = mktime(
			0,				// hour
			0,				// minute
			0,				// second
			date('n'),		// month
			date('j')+1,	// day
			date('Y')
		);
		return new DateTime(date('Y-m-d', $timestampNextDay));
	}
	
}
?>