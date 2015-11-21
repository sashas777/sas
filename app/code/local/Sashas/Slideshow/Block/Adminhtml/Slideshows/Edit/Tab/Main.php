<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Block_Adminhtml_Slideshows_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
   
{ 
    protected function _prepareForm()
    {
        $model = Mage::registry('slideshow_slideshow');       
        $form = new Varien_Data_Form();        
        $form->setHtmlIdPrefix('slideshow_');        
        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('slideshow')->__('General Slideshow Information'), 'class' => 'fieldset-wide'));
        
        if ($model->getSlideshowId()) {
            $fieldset->addField('slideshow_id', 'hidden', array(
                    'name' => 'slideshow_id',
            ));
        }
                
        $fieldset->addField('name', 'text', array(
                'name'      => 'name',
                'label'     => Mage::helper('slideshow')->__('Slideshow Name'),
                'title'     => Mage::helper('slideshow')->__('Slideshow Name'),
                'required'  => true,
                'style'   => "max-width:275px",
        ));
        
        $field = $fieldset->addField('type', 'select', array(
                'name'      => 'type',
                'options'	=> Mage::getSingleton('slideshow/source_slideshowType')->toOptionArray(),
                'label'     => Mage::helper('slideshow')->__('Slideshow Type'),
                'title'     => Mage::helper('slideshow')->__('Slideshow Type'),
                'required'  => true,
        ));
                 
        $field->setAfterElementHtml('<script type="text/javascript">
                //< ![[        
               		document.observe("dom:loaded", function() { 
		 				 
                		document.getElementById("slideshow_type").addEventListener("change",
                			function(){ 
			                		if ($$("a[id^=slideshows_edit_tabs_sliders_")[0]!=undefined) { 
			              					var href=$$("a[id^=slideshows_edit_tabs_sliders_")[0].href;
			              					href=href.replace(/(\/choosed_type\/).*?(\/)/g,"/choosed_type/"+this.value+"$2");
			              					$$("a[id^=slideshows_edit_tabs_sliders_")[0].href=href;                					 
			              					$$("a[id^=slideshows_edit_tabs_sliders_")[0].addClassName("notloaded");
			              				}
    						}, false); 	
					});         
                //]]>
                </script>');
        
        $form->setValues($model->getData());     
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
