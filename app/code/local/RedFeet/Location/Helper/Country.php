<?php

class RedFeet_Location_Helper_Country extends Mage_Core_Helper_Abstract {
    
    public function getArray() {
        $collection = Mage::getSingleton('directory/country')->getResourceCollection()
                ->loadByStore();
        $options = $collection->toOptionArray();                
        return $options;        
    }
    
    public function getDefaultId($type=null, $value=null) {
        if(!empty($value)) return $value;                
        
        $default_country_id = Mage::getStoreConfig('general/country/default');
        $id = '';
                
        Mage::helper('location')->prepareAddressParameters($has_address, $addresses);
        
        if(!$has_address) {
            return '';
        }
                
        switch($type) {
            case 'billing':
                $id = (!is_object($addresses['billing'])) ? $default_country_id : $addresses['billing']->getCountryId();
                break;                
            case 'shipping':
                $id = (!is_object($addresses['shipping'])) ? $default_country_id : $addresses['shipping']->getCountryId();
                break;                
            default:
                $id = $default_country_id;
        }
                
        return $id;
    }        
}