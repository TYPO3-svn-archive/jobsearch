<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'JobOffer' => 'index, ajaxSearch, show',
	),
	array(
		'JobOffer' => '',
	)
);

	// Hook to assign store city to the city field of the JobOffers on TCEFORM save
require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Hooks/Core.php');
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'user_Tx_Jobsearch_Hooks_Core';

?>