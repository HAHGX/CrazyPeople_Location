<?php
class RedFeet_Location_Helper_City extends Mage_Core_Helper_Abstract
{
    public function getArray($type=null, $region_id=null) {
        $country_id = Mage::helper('location/country')->getDefaultId();
                
        $collection = Mage::getModel('directory/region')->getResourceCollection()
                ->addCountryFilter($country_id)
                ->load();
                
        $options = array();
        
        if(Mage::helper('location/region')->getDefaultId($type, $region_id) != "") {
            $region = Mage::getModel('directory/region')->load(Mage::helper('location/region')->getDefaultId($type, $region_id));
                    
            $collection = Mage::getModel('location/city')->getResourceCollection()
                ->addCountryRegionIdFilter($region->getCountryId(), $region->getRegionId(), $region->getCode())
                ->load();
                        
            foreach($collection as $city) {
                $options[$city->getId()]['value'] = $city->getCityDefaultName();
                $options[$city->getId()]['label'] = $city->getCityDefaultName();
            }
                        
        }        
        
        array_unshift($options, array(
            'title '=> null,
            'value' => '',
            'label' => Mage::helper('directory')->__('-- Please select --')
        ));
                        
        return $options;        
    }
    
    public function getDefaultName($type=null, $value=null) {
        if(!empty($value)) return $value;
        
        $name = '';
        Mage::helper('location')->prepareAddressParameters($has_address, $addresses);
        
        if(!$has_address) {
            return '';
        }
        
        switch($type) {
            case 'billing':
                $name = (is_null($addresses['billing'])) ? $default_country_id : $addresses['billing']->getCity();
                break;                
            case 'shipping':
                $name = (is_null($addresses['shipping'])) ? $default_country_id : $addresses['shipping']->getCity();
                break;
        }
        
        return $name;
    }
}