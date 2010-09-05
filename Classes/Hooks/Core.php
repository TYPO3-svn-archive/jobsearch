<?php

class user_Tx_Jobsearch_Hooks_Core {

	public function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$that) {
		if($table == 'tx_jobsearch_domain_model_joboffer' && isset($fieldArray['store'])) {
			if($fieldArray['store'] > 0) {
				$storeRecord = t3lib_BEfunc::getRecord('tx_locator_locations', $fieldArray['store']);
				$fieldArray['city'] = $storeRecord['city'];
			} else {
				$fieldArray['city'] = '';
			}
		}
	}

}

?>