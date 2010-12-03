<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Job Database'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Job Database');

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/ControllerActions.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_jobsearch_domain_model_joboffer','EXT:jobsearch/Resources/Private/Language/locallang_csh_tx_jobsearch_domain_model_joboffer.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_jobsearch_domain_model_joboffer');
$TCA['tx_jobsearch_domain_model_joboffer'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs'		=> true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'endtime' => 'endtime',
			'starttime' => 'starttime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/JobOffer.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jobsearch_domain_model_joboffer.gif'
	)
);

require_once(t3lib_extMgm::extPath($_EXTKEY) . 'Classes/UserFuncs/Locator.php');
$TCA['tx_locator_locations']['ctrl']['label_alt'] = 'city';
$TCA['tx_locator_locations']['ctrl']['label_userFunc'] = 'user_Tx_Jobsearch_UserFuncs_Locator->user_getLocationsLabel';

?>