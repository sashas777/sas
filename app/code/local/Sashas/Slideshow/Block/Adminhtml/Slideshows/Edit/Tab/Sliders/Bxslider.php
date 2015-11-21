<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Tab_Sliders_Bxslider extends Mage_Adminhtml_Block_Widget_Form
   
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
        if (!isset($data['speed']))
            $data['speed']=500;
        
        if (!isset($data['randomStart']))
            $data['randomStart']=0;
        
        if (!isset($data['infiniteLoop']))
            $data['infiniteLoop']=true;
        
        if (!isset($data['template']))
            $data['template']='bxslider';
        
        if (!isset($data['responsive']))
            $data['responsive']=true;
         
        if (!isset($data['touchEnabled']))
            $data['touchEnabled']=true;
        
        if (!isset($data['pager']))
            $data['pager']=true;
        
        if (!isset($data['controls']))
            $data['controls']=true;

        if (!isset($data['autoStart']))
            $data['autoStart']=true;        
         
        if (!isset($data['autoDirection']))
            $data['autoDirection']='next';         
        
        $fieldset->addField('mode', 'select', array(
                'name'      => 'mode',
                'label'     => Mage::helper('slideshow')->__('Mode'),
                'title'     => Mage::helper('slideshow')->__('Mode'),
                'options'	=> Mage::getSingleton('slideshow/source_bxslider_mode')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Type of transition between slides</small></p>',
        ));
         
        $fieldset->addField('speed', 'text', array(
                'name'      => 'speed',
                'label'     => Mage::helper('slideshow')->__('Speed'),
                'title'     => Mage::helper('slideshow')->__('Speed'),
                'style'		=> "max-width:275px",
                'after_element_html' =>'<p class="nm"><small>Slide transition duration (in ms)</small></p>',
        ));
        
        $fieldset->addField('randomStart', 'select', array(
                'name'      => 'randomStart',
                'label'     => Mage::helper('slideshow')->__('Random Start'),
                'title'     => Mage::helper('slideshow')->__('Random Start'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Start slider on a random slide</small></p>',
        ));
        
        $fieldset->addField('infiniteLoop', 'select', array(
                'name'      => 'infiniteLoop',
                'label'     => Mage::helper('slideshow')->__('Infinite Loop'),
                'title'     => Mage::helper('slideshow')->__('Infinite Loop'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>If yes, clicking "Next" while on the last slide will transition to the first slide and vice-versa</small></p>',
        ));        
      
        
        $fieldset->addField('adaptiveHeight', 'select', array(
                'name'      => 'adaptiveHeight',
                'label'     => Mage::helper('slideshow')->__('Adaptive Height'),
                'title'     => Mage::helper('slideshow')->__('Adaptive Height'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Dynamically adjust slider height based on each slide\'s height</small></p>',
        ));

        $fieldset->addField('responsive', 'select', array(
                'name'      => 'responsive',
                'label'     => Mage::helper('slideshow')->__('Responsive'),
                'title'     => Mage::helper('slideshow')->__('Responsive'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Enable or disable auto resize of the slider. Useful if you need to use fixed width sliders.</small></p>',
        ));

        $fieldset->addField('touchEnabled', 'select', array(
                'name'      => 'touchEnabled',
                'label'     => Mage::helper('slideshow')->__('Touch Enabled'),
                'title'     => Mage::helper('slideshow')->__('Touch Enabled'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>If yes, slider will allow touch swipe transitions.</small></p>',
        ));
                 
        $fieldset->addField('template', 'text', array(
                'name'      => 'template',
                'label'     => Mage::helper('slideshow')->__('Tempalte File Name (without phtml)'),
                'title'     => Mage::helper('slideshow')->__('Tempalte File Name (without phtml))'),
                'values'	=> 'jssor',
                'style'		=> "max-width:275px",
                'after_element_html' =>'<p class="nm"><small>Please do not change it unless it custom development</small></p>',
        ));
        
        $fieldset = $form->addFieldset('slideshow_options_pager', array('legend'=>Mage::helper('slideshow')->__('Slideshow Pager Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('pager', 'select', array(
                'name'      => 'pager',
                'label'     => Mage::helper('slideshow')->__('Pager'),
                'title'     => Mage::helper('slideshow')->__('Pager'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>If yes, a pager will be added</small></p>',
        ));
         
        $fieldset = $form->addFieldset('slideshow_options_controls', array('legend'=>Mage::helper('slideshow')->__('Slideshow Controls Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('controls', 'select', array(
                'name'      => 'controls',
                'label'     => Mage::helper('slideshow')->__('Controls'),
                'title'     => Mage::helper('slideshow')->__('Controls'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>If yes, "Next" / "Prev" controls will be added</small></p>',
        ));        
        
        $fieldset = $form->addFieldset('slideshow_options_auto', array('legend'=>Mage::helper('slideshow')->__('Slideshow Auto Options'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('auto', 'select', array(
                'name'      => 'auto',
                'label'     => Mage::helper('slideshow')->__('Auto'),
                'title'     => Mage::helper('slideshow')->__('Auto'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Slides will automatically transition</small></p>',
        ));

        $fieldset->addField('autoStart', 'select', array(
                'name'      => 'autoStart',
                'label'     => Mage::helper('slideshow')->__('Auto Start'),
                'title'     => Mage::helper('slideshow')->__('Auto Start'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Auto show starts playing on load. If no, slideshow will start when the "Start" control is clicked</small></p>',
        ));
        
        $fieldset->addField('autoDirection', 'select', array(
                'name'      => 'autoDirection',
                'label'     => Mage::helper('slideshow')->__('Auto Direction'),
                'title'     => Mage::helper('slideshow')->__('Auto Direction'),
                'options'	=> Mage::getSingleton('slideshow/source_bxslider_autoDirection')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>The direction of auto show slide transitions</small></p>',
        ));
        
        $fieldset->addField('autoHover', 'select', array(
                'name'      => 'autoHover',
                'label'     => Mage::helper('slideshow')->__('Auto Hover'),
                'title'     => Mage::helper('slideshow')->__('Auto Hover'),
                'options'	=> Mage::getSingleton('slideshow/source_yesno')->toOptionArray(),
                'after_element_html' =>'<p class="nm"><small>Auto show will pause when mouse hovers over slider</small></p>',
        ));

        
        $form->setValues($data);   
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
