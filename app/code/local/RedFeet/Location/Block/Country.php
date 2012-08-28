<?php

class RedFeet_Location_Block_Country extends RedFeet_Location_Block_Abstract
{
    
    public function html() {
        $html = "<select name=\"{$this->getName()}\" id=\"{$this->getId()}\" class=\"{$this->getClass()}\">";        
        $html.=$this->_getOptions();
        $html.= "</select>";
                
        return $html;
    }
    
    protected function _getOptions() {
        $html = '';
        $country_default_id = Mage::helper('location/country')->getDefaultId($this->getType(), $this->getValue());
        $array = Mage::helper('location/country')->getArray();
        
        foreach($array as $country_data) {
            $selected = ($country_data['value'] == $country_default_id) ? 'selected="selected"' : '';
            $html.="<option value=\"{$country_data['value']}\" {$selected}>{$country_data['label']}</option>";
        }
        
        return $html;
    }
    
    public function getClass() {
        return ($this->_class == '') ? 'location_country' : $this->_class.' location_country';
    }
    
}
