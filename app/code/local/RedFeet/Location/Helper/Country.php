<?php

class RedFeet_Location_Helper_Country extends Mage_Core_Helper_Abstract {
    
    public function getArray() {
        $collection = Mage::getSingleton('directory/country')->getResourceCollection()
                ->loadByStore();
        $options = $collection->toOptionArray();                
        return $options;        
    }
    
    public function getDefaultId($type=null) {
        $default_country_id = Mage::getStoreConfig('general/country/default');
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $addresses = array();
        $id = '';
        
        $has_address = true;
        
        if(is_null($customer)) {
            $has_address = false;
        }
        
        if($has_address) {
            $addresses['billing'] = $customer->getPrimaryBillingAddress();
            $addresses['shipping'] = $customer->getPrimaryShippingAddress();
        }
        
        switch($type) {
            case 'billing':
                $id = (is_null($addresses['billing'])) ? $default_country_id : $addresses['billing']->getCountryId();
                break;                
            case 'shipping':
                $id = (is_null($addresses['shipping'])) ? $default_country_id : $addresses['shipping']->getCountryId();
                break;                
            default:
                $id = $default_country_id;
        }
        
        return $id;
    }        
}