<?php
class RedFeet_Location_Model_City extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('location/city');
    }

    /**
     * Retrieve region name
     *
     * If name is no declared, then default_name is used
     *
     * @return string
     */
    public function getName()
    {
        $name = $this->getData('name');
        if (is_null($name)) {
            $name = $this->getData('default_name');
        }
        return $name;
    }

    public function loadByCode($code, $regionId)
    {
        if ($code) {
            $this->_getResource()->loadByCode($this, $code, $regionId);
        }
        return $this;
    }

    public function loadByName($name, $regionId)
    {
        $this->_getResource()->loadByName($this, $name, $regionId);
        return $this;
    }
    
    public function teste(){
        return "test";
    }

}
