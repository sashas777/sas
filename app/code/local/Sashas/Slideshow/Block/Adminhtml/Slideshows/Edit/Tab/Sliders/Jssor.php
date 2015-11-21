<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Tab_Sliders_Jssor extends Mage_Adminhtml_Block_Widget_Form
   
{ 
    protected function _prepareForm()
    {
        $model = Mage::registry('slideshow_slideshow');       
        $form = new Varien_Data_Form();        
        $form->setHtmlIdPrefix('slideshow_');        
        $fieldset = $form->addFieldset('slideshow_options', array('legend'=>Mage::helper('slideshow')->__('Slideshow Options'), 'class' => 'fieldset-wide'));
        
 		/*Get and unserialize data*/       
        $slideshow_options=$model->getSlideshowOptions();
        $data=unserialize($slideshow_options);
        /*Get and unserialize data*/
        
        /* Default values */
        if (!isset($data['SlideDuration']))
            $data['SlideDuration']=500;

        if (!isset($data['Scale']))
            $data['Scale']=1;
        
        if (!isset($data['template']))
            $data['template']='jssor';
 
        
        foreach ($data as $k=>$v) {
        	if (is_array($v)) 
        	    foreach ($v as $v_k=>$v_v) 
        	    	 $data[$k.'_'.$v_k]=$v_v;        	           	            
        }         
        
        /* Default values */
        
        $fieldset->addField('FillMode', 'select', array(
                'name'      => 'FillMode',
                'label'     => Mage::helper('slideshow')->__('Fill Mode'),
                'title'     => Mage::helper('slideshow')->__('Fill Mode'),       
                'options'	=> Mage::getSingleton('slideshow/source_jssor_fillMode')->toOptionArray(),               
        ));
       
        $fieldset->addField('AutoPlay', 'select', array(
                'name'      => 'AutoPlay',
                'label'     => Mage::helper('slideshow')->__('AutoPlay'),
                'title'     => Mage::helper('slideshow')->__('AutoPlay'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
        ));
        
        $fieldset->addField('Loop', 'select', array(
                'name'      => 'Loop',
                'label'     => Mage::helper('slideshow')->__('Loop'),
                'title'     => Mage::helper('slideshow')->__('Loop'),                 
                'options'	=> Mage::getSingleton('slideshow/source_jssor_loop')->toOptionArray(),
        ));
        
        $fieldset->addField('PauseOnHover', 'select', array(
                'name'      => 'PauseOnHover',
                'label'     => Mage::helper('slideshow')->__('Pause On Hover'),
                'title'     => Mage::helper('slideshow')->__('Pause On Hover'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_pauseOnHover')->toOptionArray(),
        ));
        
        $fieldset->addField('SlideDuration', 'text', array(
                'name'      => 'SlideDuration',
                'label'     => Mage::helper('slideshow')->__('Slide Duration'),
                'title'     => Mage::helper('slideshow')->__('Slide Duration'),
                'style'		=> "max-width:275px",                 
        ));
         
        $fieldset->addField('PlayOrientation', 'select', array(
                'name'      => 'PlayOrientation',
                'label'     => Mage::helper('slideshow')->__('Play Orientation'),
                'title'     => Mage::helper('slideshow')->__('Play Orientation'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_playOrientation')->toOptionArray(),
        ));           

        $fieldset->addField('template', 'text', array(
                'name'      => 'template',
                'label'     => Mage::helper('slideshow')->__('Tempalte File Name (without phtml)'),
                'title'     => Mage::helper('slideshow')->__('Tempalte File Name (without phtml))'),
                'values'	=> 'jssor',
                'style'		=> "max-width:275px",
                'after_element_html' =>'<p class="nm"><small>Please do not change it unless it custom development</small></p>',
        ));
        
        $fieldset = $form->addFieldset('slideshow_options_bullet', array('legend'=>Mage::helper('slideshow')->__('Bullet Navigation Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('BulletNavigatorOptions_ChanceToShow', 'select', array(
                'name'      => 'BulletNavigatorOptions[ChanceToShow]',
                'label'     => Mage::helper('slideshow')->__('Chance To Show'),
                'title'     => Mage::helper('slideshow')->__('Chance To Show'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_chanceToShow')->toOptionArray(),
        ));
        
        $fieldset->addField('BulletNavigatorOptions_AutoCenter', 'select', array(
                'name'      => 'BulletNavigatorOptions[AutoCenter]',
                'label'     => Mage::helper('slideshow')->__('Auto Center'),
                'title'     => Mage::helper('slideshow')->__('Auto Center'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_autoCenter')->toOptionArray(),
        ));
        
         
        $fieldset->addField('BulletNavigatorOptions_Orientation', 'select', array(
                'name'      => 'BulletNavigatorOptions[Orientation]',
                'label'     => Mage::helper('slideshow')->__('Orientation'),
                'title'     => Mage::helper('slideshow')->__('Orientation'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_playOrientation')->toOptionArray(),
        ));    

        
        $fieldset->addField('BulletNavigatorOptions_Scale', 'select', array(
                'name'      => 'BulletNavigatorOptions[Scale]',
                'label'     => Mage::helper('slideshow')->__('Scale'),
                'title'     => Mage::helper('slideshow')->__('Scale'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Scales bullet navigator or not while slider scale</small></p>',
        ));
        
        $fieldset = $form->addFieldset('slideshow_options_arrows', array('legend'=>Mage::helper('slideshow')->__('Arrow Navigation Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('ArrowNavigatorOptions_ChanceToShow', 'select', array(
                'name'      => 'ArrowNavigatorOptions[ChanceToShow]',
                'label'     => Mage::helper('slideshow')->__('Chance To Show'),
                'title'     => Mage::helper('slideshow')->__('Chance To Show'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_chanceToShow')->toOptionArray(),
        ));
        
        $fieldset->addField('ArrowNavigatorOptions_AutoCenter', 'select', array(
                'name'      => 'ArrowNavigatorOptions[AutoCenter]',
                'label'     => Mage::helper('slideshow')->__('Auto Center'),
                'title'     => Mage::helper('slideshow')->__('Auto Center'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_autoCenter')->toOptionArray(),
        ));
                 
        $fieldset->addField('ArrowNavigatorOptions_Scale', 'select', array(
                'name'      => 'ArrowNavigatorOptions[Scale]',
                'label'     => Mage::helper('slideshow')->__('Scale'),
                'title'     => Mage::helper('slideshow')->__('Scale'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Scales bullet navigator or not while slider scale</small></p>',
        ));
        
        $fieldset = $form->addFieldset('slideshow_options_thumbnail', array('legend'=>Mage::helper('slideshow')->__('Thumbnail Navigation Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('ThumbnailNavigatorOptions_ChanceToShow', 'select', array(
                'name'      => 'ThumbnailNavigatorOptions[ChanceToShow]',
                'label'     => Mage::helper('slideshow')->__('Chance To Show'),
                'title'     => Mage::helper('slideshow')->__('Chance To Show'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_chanceToShow')->toOptionArray(),
        ));
        
        $fieldset->addField('ThumbnailNavigatorOptions_AutoCenter', 'select', array(
                'name'      => 'ThumbnailNavigatorOptions[AutoCenter]',
                'label'     => Mage::helper('slideshow')->__('Auto Center'),
                'title'     => Mage::helper('slideshow')->__('Auto Center'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_autoCenter')->toOptionArray(),
        ));
        
        
        $fieldset->addField('ThumbnailNavigatorOptions_Orientation', 'select', array(
                'name'      => 'ThumbnailNavigatorOptions[Orientation]',
                'label'     => Mage::helper('slideshow')->__('Orientation'),
                'title'     => Mage::helper('slideshow')->__('Orientation'),
                'options'	=> Mage::getSingleton('slideshow/source_jssor_playOrientation')->toOptionArray(),
        ));
        
         
        $fieldset->addField('ThumbnailNavigatorOptions_Scale', 'select', array(
                'name'      => 'ThumbnailNavigatorOptions[Scale]',
                'label'     => Mage::helper('slideshow')->__('Scale'),
                'title'     => Mage::helper('slideshow')->__('Scale'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Scales bullet navigator or not while slider scale</small></p>',
        ));        
        
        $form->setValues($data);     
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
