<?php

class RedFeet_Location_Helper_Region extends Mage_Core_Helper_Abstract
{
    public function getArray($type=null, $country_id_param=null) {            
        $country_id = Mage::helper('location/country')->getDefaultId($type, $country_id_param);                
                
        $collection = Mage::getModel('directory/region')->getResourceCollection()
                ->addCountryFilter($country_id)
                ->load();
        
        $options = array();                    
        foreach($collection as $region) {
            $options[$region->getId()]['value'] = $region->getId();
            $options[$region->getId()]['label'] = $region->getName();
        }
        
        array_unshift($options, array(
            'title '=> null,
            'value' => '',
            'label' => Mage::helper('directory')->__('-- Please select --')
        ));
                        
        return $options;        
    }
    
    public function getDefaultId($type=null, $value=null) {
        if(!empty($value)) return $value;
        
        $id = '';
        Mage::helper('location')->prepareAddressParameters($has_address, $addresses);
                
        if(!$has_address) {
            return '';
        }
        
        switch($type) {
            case 'billing':
                $id = (is_null($addresses['billing'])) ? $default_country_id : $addresses['billing']->getRegionId();
                break;                
            case 'shipping':
                $id = (is_null($addresses['shipping'])) ? $default_country_id : $addresses['shipping']->getRegionId();
                break;            
        }
                
        return $id;
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
                $name = (is_null($addresses['billing'])) ? $default_country_id : $addresses['billing']->getRegion();
                break;                
            case 'shipping':
                $name = (is_null($addresses['shipping'])) ? $default_country_id : $addresses['shipping']->getRegion();
                break;
        }
        
        return $name;
    }
}