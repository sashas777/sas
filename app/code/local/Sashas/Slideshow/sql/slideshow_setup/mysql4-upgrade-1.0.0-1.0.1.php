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

$installer->getConnection()->addForeignKey(
        $installer->getFkName('slideshow/slideshows_slide', 'slideshow_id', 'slideshow/slideshows', 'slideshow_id'),
        $installer->getTable('slideshow/slideshows_slide'),
        'slideshow_id',
        $installer->getTable('slideshow/slideshows'),
        'slideshow_id'
);

$installer->getConnection()->addForeignKey(
        $installer->getFkName('slideshow/slideshows_slide', 'slide_id', 'slideshow/slides', 'slide_id'),
        $installer->getTable('slideshow/slideshows_slide'),
        'slide_id',
        $installer->getTable('slideshow/slides'),
        'slide_id'
);

$installer->endSetup();