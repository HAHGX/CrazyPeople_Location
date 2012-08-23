<?php
class RedFeet_Location_Model_Mysql4_City_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Locale region name table name
     *
     * @var string
     */
    protected $_cityNameTable;

    /**
     * Country table name
     *
     * @var string
     */
    protected $_regionTable;
    
    public function _construct()
    {
        parent::_construct();
        $this->_init('location/city');
        $this->_regionTable    = $this->getTable('directory/country_region');
        $this->_cityNameTable = $this->getTable('location/city');
    }
    
    /**
     * Initialize select object
     *
     * @return Mage_Directory_Model_Resource_Region_Collection
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            array('rname' => $this->_regionTable),
            'main_table.city_region_id = rname.code ');

        return $this;
    }
    
    public function addCountryRegionIdFilter($countryId, $regionId, $regionCode)
    {
        $this->getSelect()
            ->where('rname.region_id = ?', $regionId)
            ->where('rname.code = ?', $regionCode)
            ->where('main_table.city_country_id = ?', $countryId);

        return $this;
    }
    
    public function toOptionArray()
    {
        $options = $this->_toOptionArray('city_default_name', 'city_default_name', array('title' => 'city_default_name'));
                
        array_unshift($options, array(
            'title '=> null,
            'value' => '',
            'label' => Mage::helper('directory')->__('-- Please select --')
        ));
        
        return $options;
    }
}
