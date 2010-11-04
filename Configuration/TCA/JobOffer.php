<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_jobsearch_domain_model_joboffer'] = array(
	'ctrl' => $TCA['tx_jobsearch_domain_model_joboffer']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title,type,description,store'
	),
	'types' => array(
		'1' => array('showitem' => 'title;;1,description;;;richtext[]:rte_transform[mode=ts_css],store;;2')
	),
	'palettes' => array(
		'1' => array('showitem' => 'type'),
		'2' => array('showitem' => 'channel,city')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_jobsearch_domain_model_joboffer',
				'foreign_table_where' => 'AND tx_jobsearch_domain_model_joboffer.uid=###REC_FIELD_l18n_parent### AND tx_jobsearch_domain_model_joboffer.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'city' => array(
			'exclude' => 0,
			'label'   => 'Ort',
			'config'  => array(
				'type' => 'none',
				'size' => '20'
			)
		),
		'channel' => array(
			'exclude' => 0,
			'label'   => 'Vertriebslinie',
			'config'  => array(
				'type' => 'select',
				'items' => array(
					array('', ''),
					array('coop', 'coop'),
					array('plaza', 'plaza'),
					array('sky', 'sky')
				)
			)
		),
		'type' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer.type',
			'config'  => array(
				'type' => 'select',
				'items' => array (
					array('Vollzeitstelle', 1),
					array('Ausbildungsplatz', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer.description',
			'config'  => array(
				'type' => 'text',
			)
		),
		'store' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:jobsearch/Resources/Private/Language/locallang_db.xml:tx_jobsearch_domain_model_joboffer.store',
			'config'  => array(
				'type' => 'select',
				'items' => array(
					array('', '')
				),
				'foreign_table' => 'tx_locator_locations',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
	),
);
?>