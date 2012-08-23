<?php
class RedFeet_Location_Model_Mysql4_City extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('location/city', 'city_id');
    }
}
