<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */


$installer = $this;
$installer->startSetup();
 
/* Slideshows */
$table = $installer->getConnection()->newTable($installer->getTable('slideshow/slideshows'))
	->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
			'unsigned' => true,
			'nullable' => false,
			'primary' => true,
			'identity' => true,
	), 'Slideshow ID')
	->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
			'nullable' => false,
	), 'Slideshow Name')
	->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
	        'nullable' => false,
	), 'Slideshow Type')	
	->addColumn('slideshow_options', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
			'nullable' => false,
	), 'Slideshow Options') 
	->setComment('Slideshows Table');
$installer->getConnection()->createTable($table);

/* Slides */
$table = $installer->getConnection()->newTable($installer->getTable('slideshow/slides'))
->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
), 'Slide ID')
->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
), 'Slide Name')
->addColumn('slide_image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
), 'Slide Image')
->setComment('Slides Table');
$installer->getConnection()->createTable($table);

/* Slideshow Slides Relation */
$table = $installer->getConnection()->newTable($installer->getTable('slideshow/slideshows_slide'))
->addColumn('slideshows_slide_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
), 'SlideShow Slide ID')
->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
), 'Slideshow ID')
->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
), 'Slide ID')
->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
), 'Slide Position')
->setComment('Slideshow Slides Table');
$installer->getConnection()->createTable($table);


$installer->endSetup();