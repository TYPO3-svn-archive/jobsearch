<?php

class user_Tx_Jobsearch_UserFuncs_Locator {

	public function user_getLocationsLabel($params, $pObj) {
	
		$row = t3lib_BEfunc::getRecord('tx_locator_locations', $params['row']['uid']);
		$params['title'] = $row['storename'] . ' (' . $row['city'] . ')';
	
	}

}

?>