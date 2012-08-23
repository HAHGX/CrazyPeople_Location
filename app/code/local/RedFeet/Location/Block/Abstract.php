<?php

class RedFeet_Location_Block_Abstract extends Mage_Page_Block_Html
{
    private $_name;    
    private $_id;    
    private $_class;    
    private $_type;
    private $_style = array();
    private $_value;
    
    public function setName($name) {
        $this->_name = $name;
        return $this;
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    public function setClass($class) {
        $this->_class = $class;
        return $this;
    }        
    
    public function setType($type) {
        $this->_type = $type;
        return $this;
    }
    
    public function getType() {
        return $this->_type;
    }
    
    public function addStyle($property, $value) {
        $this->_style[$property] = $value;
        return $this;
    }
    
    public function getStyles() {
        $styles = '';
        foreach($this->_style as $property=>$value) {
            $styles.="{$property}: {$value};";
        }
        return $styles;
    }
    
    public function setValue($value) {
        $this->_value = $value;
        return $this;
    }
    
    public function getValue() {
        return $this->_value;
    }
}