<?php
class RedFeet_Location_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
	Mage::setIsDeveloperMode(true);
	echo "<br>class: ".get_class(Mage::helper('location'));
	echo "<br>class: ".get_class(Mage::getModel('location/city'));
	echo "<br>colletion: ".get_class(Mage::getModel('location/city')->getResourceCollection());
	echo "<br>cityJson".Mage::helper('location')->getCityJson();
    }
    
}