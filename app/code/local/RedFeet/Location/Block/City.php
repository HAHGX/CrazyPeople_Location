<?php

class RedFeet_Location_Block_City extends RedFeet_Location_Block_Abstract
{
    private $_region_id;
    
    public function html() {
        $html = '';
        if(count(Mage::helper('location/city')->getArray($this->getType(), $this->_region_id)) <= 1) {
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
        $city_default = Mage::helper('location/city')->getDefaultName($this->getType(), $this->getValue());
        
        $array = Mage::helper('location/city')->getArray($this->getType(), $this->_region_id);
        
        foreach($array as $city_data) {
            $selected = ($city_data['value'] == $city_default) ? 'selected="selected"' : '';
            $html.="<option value=\"{$city_data['value']}\" {$selected}>{$city_data['label']}</option>";
        }
        
        return $html;
    }
    
    protected function _getInputHtml() {
        return "<input type='text' name=\"{$this->getName()}\" id=\"{$this->getId()}_text\" value='".Mage::helper('location/city')->getDefaultName($this->getType())."' class=\"{$this->getClass()} input-text\" />";
    }
    
    public function getClass() {
        return ($this->_class == '') ? 'location_city' : $this->_class.' location_city';
    }
    
    public function setRegionId($region_id) {
        $this->_region_id = $region_id;
        return $this;
    }
}