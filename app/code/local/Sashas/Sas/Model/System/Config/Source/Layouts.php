<?php
/**
 * @package     sas_default
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */
 
class Sashas_Sas_Model_System_Config_Source_Layouts {
    
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'page/empty.phtml', 'label'=>Mage::helper('sas')->__('Empty')),
            array('value' => 'page/2columns-left.phtml', 'label'=>Mage::helper('sas')->__('2 Columns Left')),
            array('value' => 'page/2columns-right.phtml', 'label'=>Mage::helper('sas')->__('2 Columns Right')),
            array('value' => 'page/3columns.phtml', 'label'=>Mage::helper('sas')->__('3 Columns')),
            array('value' => 'page/1column.phtml', 'label'=>Mage::helper('sas')->__('1 Column')),
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
 			array('value' => 'page/empty.phtml', 'label'=>Mage::helper('sas')->__('Empty')),
            array('value' => 'page/2columns-left.phtml', 'label'=>Mage::helper('sas')->__('2 Columns Left')),
            array('value' => 'page/2columns-right.phtml', 'label'=>Mage::helper('sas')->__('2 Columns Right')),
            array('value' => 'page/3columns.phtml', 'label'=>Mage::helper('sas')->__('3 Columns')),
            array('value' => 'page/1column.phtml', 'label'=>Mage::helper('sas')->__('1 Column')),
        );
    }
}