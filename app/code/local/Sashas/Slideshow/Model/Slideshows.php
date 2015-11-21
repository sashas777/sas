<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Slideshows extends Mage_Core_Model_Abstract
{
    const CACHE_TAG     = 'slideshow_slideshows';
    protected $_cacheTag= 'slideshow_slideshows';

    protected function _construct()
    {
        $this->_init('slideshow/slideshows');
    }

 
    /**
     * Retrieve array of slide id's for slideshow
     *
     * array($SlideId => $position)
     *
     * @return array
     */
    public function getSlidesPosition()
    {
        if (!$this->getId()) {
            return array();
        }
    
        $array = $this->getData('slideshow_slides');      
        if (is_null($array)) {
            $res = $this->getResource()->getSlidesPosition($this);
            $array=array();
            /* Fix For Save Event Js*/
            foreach ($res as $k=>$v) {
                $array[$k]['position']=$v;
            }
           
            $this->setData('slideshow_slides', $array);
        }
        return $array;
    }
    
    /**
     * Saving slideshow slides relation
     *
     * @return Sashas_Slideshow_Model_Slideshows
     */
    protected function _afterSave()
    {
        $this->getResource()->saveSlideshowSlides($this);       
        return parent::_afterSave();
    }
    
    public function getSlidesCollection(){  
        $slides=Mage::getModel('slideshow/slideshows_slide')->getCollection()
        	->addFieldToFilter('slideshow_id', array('eq'=>$this->getId()));
      
        $slides->getSelect()->joinInner( array('slide'=>Mage::getSingleton('core/resource')->getTableName('slideshow/slides')),
                 'slide.slide_id = main_table.slide_id', array('slide.slide_image', 'slide.url'));
        	 
        $slides->getSelect()->order('position');        
        return $slides;
    }
    
}
