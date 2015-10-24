<?php
/**
 * @package     sas_default
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */
 
class Sashas_Sas_Model_Core_Layout extends Mage_Core_Model_Layout
{

    /**
     * Enter description here...
     *
     * @param $node Varien_Simplexml_Element           
     * @param $parent Varien_Simplexml_Element           
     * @return Mage_Core_Model_Layout
     */
    protected function _generateAction($node, $parent)
    {
        if (isset($node['ifconfig']) && ($configPath = (string) $node['ifconfig'])) {
            /*Sashas*/
            if (isset($node['condition'])) {                 
                if (Mage::getStoreConfig($node['ifconfig'])!=$node['condition'])
                    return $this;
            } else {
                if (!Mage::getStoreConfigFlag($configPath)) 
                    return $this;                
            }                        
            /*Sashas*/
        }
        
        $method = (string) $node['method'];
        if (!empty($node['block'])) {
            $parentName = (string) $node['block'];
        } else {
            $parentName = $parent->getBlockName();
        }
        
        $_profilerKey = 'BLOCK ACTION: ' . $parentName . ' -> ' . $method;
        Varien_Profiler::start($_profilerKey);
        
        if (!empty($parentName)) {
            $block = $this->getBlock($parentName);
        }
        if (!empty($block)) {
            
            $args = (array) $node->children();
            unset($args['@attributes']);
            
            foreach ( $args as $key => $arg ) {
                if (($arg instanceof Mage_Core_Model_Layout_Element)) {
                    if (isset($arg['helper'])) {
                        $helperName = explode('/', (string) $arg['helper']);
                        $helperMethod = array_pop($helperName);
                        $helperName = implode('/', $helperName);
                        $arg = $arg->asArray();
                        unset($arg['@']);
                        $args[$key] = call_user_func_array(
                            array(
                                    Mage::helper($helperName), 
                                    $helperMethod
                            ), $arg);
                    } else {
                        /**
                         * if there is no helper we hope that this is assoc
                         * array
                         */
                        $arr = array();
                        foreach ( $arg as $subkey => $value ) {
                            $arr[(string) $subkey] = $value->asArray();
                        }
                        if (!empty($arr)) {
                            $args[$key] = $arr;
                        }
                    }
                }
            }
            
            if (isset($node['json'])) {
                $json = explode(' ', (string) $node['json']);
                foreach ( $json as $arg ) {
                    $args[$arg] = Mage::helper('core')->jsonDecode($args[$arg]);
                }
            }
            
            $this->_translateLayoutNode($node, $args);
            call_user_func_array(array(
                    $block, 
                    $method
            ), $args);
        }
        
        Varien_Profiler::stop($_profilerKey);
        
        return $this;
    }
}