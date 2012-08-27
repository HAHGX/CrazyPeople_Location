<?php

class RedFeet_Location_Block_Region extends RedFeet_Location_Block_Abstract
{
    private $_country_id;
    
    public function html() {
        $html = '';
        if(count(Mage::helper('location/region')->getArray($this->getType(), $this->_country_id)) <= 1 || !is_integer($this->getValue())) {
            $this->addStyle('display', 'none;');
            $html.=$this->_getSelectHtml();
            $html.=$this->_getInputHtml();
        } else {
            $html.=$this->_getSelectHtml();
        }
        
        return $html;
    }
    
    protected function _getSelectHtml() {
        $html = "<select name=\"{$this->getName()}\" id=\"{$this->getId()}\" class=\"{$this->getClass()}\" style=\"{$this->getStyles()}\">";
        $html.=$this->_getOptions();
        $html.= "</select>";
                
        return $html;
    }
    
    protected function _getOptions() {
        $html = '';
        $region_default_id = Mage::helper('location/region')->getDefaultId($this->getType(), $this->getValue());
                
        $array = Mage::helper('location/region')->getArray($this->getType(), $this->_country_id);
        
        foreach($array as $region_data) {
            $selected = ($region_data['value'] == $region_default_id) ? 'selected="selected"' : '';
            $html.="<option value=\"{$region_data['value']}\" {$selected}>{$region_data['label']}</option>";
        }
        
        return $html;
    }
    
    protected function _getInputHtml() {
        $name = str_replace('_id', '', $this->getName());
        return "<input type='text' name=\"{$name}\" id=\"{$this->getId()}_text\" value='".Mage::helper('location/region')->getDefaultId($this->getType(), $this->getValue())."' class=\"{$this->getClass()} input-text\" />";
    }
    
    public function getClass() {
        return ($this->_class == '') ? 'location_region' : $this->_class.' location_region';
    }
    
    public function setCountryId($country_id) {
        $this->_country_id = $country_id;
        return $this;
    }
}