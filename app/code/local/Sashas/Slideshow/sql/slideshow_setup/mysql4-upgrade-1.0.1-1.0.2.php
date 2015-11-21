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
$installer->getConnection()->addColumn($installer->getTable('slideshow/slides'), 'url', 'varchar(255)');
$installer->endSetup();