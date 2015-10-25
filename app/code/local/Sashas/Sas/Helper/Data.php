<?php
/**
 * @package     sas_default
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */
 
class Sashas_Sas_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function categoryLayout(){
	    return Mage::getStoreConfig('sas/sas_layout/category_layout');
	}
    
}