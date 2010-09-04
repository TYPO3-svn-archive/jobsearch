<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Job Database'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Job Database');

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_jobsearch_domain_model_joboffer','EXT:jobsearch/Resources/Private/Language/locallang_csh_tx_jobsearch_domain_model_joboffer.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_jobsearch_domain_model_joboffer');
$TCA['tx_jobsearch_domain_model_joboffer'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/JobOffer.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jobsearch_domain_model_joboffer.gif'
	)
);

?>