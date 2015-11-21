<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Slideshow
 * @copyright   Copyright (c) 2015 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)
 */

class Sashas_Slideshow_Model_Resource_Slideshows extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Slideshows slide table name
     *
     * @var string
     */
    protected $_slideshowSlidesTable;

	/**
	 * Initialize resource model
	 *
	 */
	protected function _construct()
	{
		$this->_init('slideshow/slideshows', 'slideshow_id');
		$this->_slideshowSlidesTable = $this->getTable('slideshow/slideshows_slide');
	}
		
	/**
	 * Get positions of associated to slideshow slides
	 *
	 * @param Sashas_Slideshow_Model_Slideshows $slideshow
	 * @return array
	 */
	public function getSlidesPosition($slideshow)
	{
	    $select = $this->_getWriteAdapter()->select()
	    	->from($this->_slideshowSlidesTable, array('slide_id', 'position'))
	    	->where('slideshow_id = :slideshow_id');
	    $bind = array('slideshow_id' => (int)$slideshow->getId());	 
	    return $this->_getWriteAdapter()->fetchPairs($select, $bind);
	}
	
	/**
	 * @param Sashas_Slideshow_Model_Slideshows $slideshow
	 * @return Sashas_Slideshow_Model_Resource_Slideshows
	 */
	public function saveSlideshowSlides($slideshow){
	    $data = $slideshow->getSlideshowSlides();
	    
	    /*Bug when ajax tab not loaded*/
	    if (!is_array($data))
	        return $this;
	    
	    $adapter    = $this->_getWriteAdapter();
 
	    $deleteIds = array();
		$deleteIds[] = (int)$slideshow->getId();
	    
	    if (!empty($deleteIds)) {
	        $adapter->delete($this->_slideshowSlidesTable, array(
	                'slideshow_id IN (?)' => $deleteIds,
	        ));
	    }
	    
	    foreach ($data as $slideId => $slidePosArr) {
	        $linkId = null;
	        if (isset($slidePosArr['position']) && $slidePosArr['position']!==false) {	           
	            $bind = array(
	                    'slideshow_id'        => $slideshow->getId(),
	                    'slide_id' => $slideId,
	                    'position'      => $slidePosArr['position']
	            );
	            $adapter->insert($this->_slideshowSlidesTable, $bind);
	            $linkId = $adapter->lastInsertId($this->_slideshowSlidesTable);
	        }
	    }
	    
	    return $this;	    	   
	}
 
 
}
