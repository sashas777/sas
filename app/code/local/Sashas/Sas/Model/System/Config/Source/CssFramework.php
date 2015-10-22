<?php
/**
 * @package     sas_default
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */
 
class Sashas_Sas_Model_System_Config_Source_CssFramework {
    
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'bootstrap', 'label'=>Mage::helper('sas')->__('Bootstrap v3')),
            array('value' => 'foundation', 'label'=>Mage::helper('sas')->__('Foundation')),
        );
    }
    
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
           'bootstrap' => Mage::helper('sas')->__('Bootstrap v3'),
           'foundation' => Mage::helper('sas')->__('Foundation'),
        );
    }
}