<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshows
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slides_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('slideshow')->__('Slide Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('slideshow')->__('Slide Information');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('slideshow_slide');
       
        $form = new Varien_Data_Form();
        
        $form->setHtmlIdPrefix('slide');
        
        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('slideshow')->__('General Slide Information'), 'class' => 'fieldset-wide'));
        
        if ($model->getSlideId()) {
            $fieldset->addField('slide_id', 'hidden', array(
                    'name' => 'slide_id',
            ));
        }
        
        
        $fieldset->addField('name', 'text', array(
                'name'      => 'name',
                'label'     => Mage::helper('slideshow')->__('Slide Name'),
                'title'     => Mage::helper('slideshow')->__('Slide Name'),
                'required'  => true,
                'style'   => "max-width:275px",
        ));
        
        $fieldset->addField('slide_image', 'image', array(
                'name'      => 'slide_image',                
                'label'     => Mage::helper('slideshow')->__('Slide Image'),
                'title'     => Mage::helper('slideshow')->__('Slide Image'),
                'required'  => true,
        ));
        
        $fieldset->addField('url', 'text', array(
                'name'      => 'url',
                'label'     => Mage::helper('slideshow')->__('Slide Url'),
                'title'     => Mage::helper('slideshow')->__('Slide Url'),
                'required'  => true,
                'style'   => "max-width:275px",
                'after_element_html' =>'<p class="nm"><small>{{store_url}} will be replaced with website url.</small></p>',
        ));
        
        
        $form->setValues($model->getData());      
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
