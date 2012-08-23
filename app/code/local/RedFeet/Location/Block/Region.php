<?php

class RedFeet_Location_Block_Region extends RedFeet_Location_Block_Abstract
{
    public function html() {
        $html = '';
        if(count(Mage::helper('location/region')->getArray()) <= 1) {
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
                
        $array = Mage::helper('location/region')->getArray();
        
        foreach($array as $region_data) {
            $selected = ($region_data['value'] == $region_default_id) ? 'selected="selected"' : '';
            $html.="<option value=\"{$region_data['value']}\" {$selected}>{$region_data['label']}</option>";
        }
        
        return $html;
    }
    
    protected function _getInputHtml() {
        return "<input type='text' name=\"{$this->getName()}\" id=\"{$this->getId()}_text\" value='".Mage::helper('location/region')->getDefaultName()."' class=\"{$this->getClass()} input-text\" />";
    }
    
    public function getClass() {
        return ($this->_class == '') ? 'location_region' : $this->_class.' location_region';
    }
}