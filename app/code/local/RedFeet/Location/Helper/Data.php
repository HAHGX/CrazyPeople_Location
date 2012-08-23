<?php
class RedFeet_Location_Helper_Data extends Mage_Directory_Helper_Data
{
    /**
     * Json representation of cities data
     *
     * @var string
     */
    protected $_cityJson;
    
    public function getCityJson()
    {    
        Varien_Profiler::start('TEST: '.__METHOD__);
        if (!$this->_regionJson) {
            $cacheKey = 'DIRECTORY_CITIES_JSON_STORE'.Mage::app()->getStore()->getId();
            if (Mage::app()->useCache('config')) {
                $json = Mage::app()->loadCache($cacheKey);
            }                    
            if (empty($json)) {
                $countryIds = array();
                foreach ($this->getCountryCollection() as $country) {
                    $countryIds[] = $country->getCountryId();
                }
                $collection = Mage::getModel('directory/region')->getResourceCollection()
                    ->addCountryFilter($countryIds)
                    ->load();
                $regions = array();
                foreach ($collection as $region) {
                    if (!$region->getRegionId()) {
                        continue;
                    }
                                        
                    $cityCollection = Mage::getModel('location/city')->getResourceCollection()
                        ->addCountryRegionIdFilter($region->getCountryId(), $region->getRegionId(), $region->getCode())
                        ->load();
                        
                    $cities = array();
                    foreach($cityCollection->getItems() as $city) {
                        $cities[$city->getCityId()]['code'] = $city->getData('city_default_name');
                        $cities[$city->getCityId()]['name'] = $city->getData('city_default_name');
                    }
                    
                    $regions[$region->getRegionId()] = $cities;
                }
                                
                $json = Mage::helper('core')->jsonEncode($regions);

                if (Mage::app()->useCache('config')) {
                    Mage::app()->saveCache($json, $cacheKey, array('config'));
                }
            }
            $this->_cityJson = $json;
        }            

        Varien_Profiler::stop('TEST: '.__METHOD__);
        return $this->_cityJson;
    }
    
    /**
     * Retrieve region collection
     *
     * @return Mage_Directory_Model_Resource_Region_Collection
     */
    public function getRegionCollection()
    {
        if (!$this->_regionCollection) {
            $this->_regionCollection = Mage::getModel('directory/region')->getResourceCollection()
                ->load();
        }
        return $this->_regionCollection;
    }
    
    public function getRegionJson()
    {
        Varien_Profiler::start('TEST: '.__METHOD__);
        if (!$this->_regionJson) {
            $cacheKey = 'DIRECTORY_REGIONS_JSON_STORE'.Mage::app()->getStore()->getId();
            if (Mage::app()->useCache('config')) {
                $json = Mage::app()->loadCache($cacheKey);
            }
            if (empty($json)) {
                $countryIds = array();
                foreach ($this->getCountryCollection() as $country) {
                    $countryIds[] = $country->getCountryId();
                }
                $collection = Mage::getModel('directory/region')->getResourceCollection()
                    ->addCountryFilter($countryIds)
                    ->load();
                $regions = array();
                foreach ($collection as $region) {
                    if (!$region->getRegionId()) {
                        continue;
                    }
                    $regions[$region->getCountryId()][$region->getRegionId()] = array(
                        'code' => $region->getId(),
                        'name' => $this->__($region->getName())
                    );
                }
                $json = Mage::helper('core')->jsonEncode($regions);

                if (Mage::app()->useCache('config')) {
                    Mage::app()->saveCache($json, $cacheKey, array('config'));
                }
            }
            $this->_regionJson = $json;
        }

        Varien_Profiler::stop('TEST: '.__METHOD__);
        return $this->_regionJson;
    }
    
    public function prepareAddressParameters(&$has_address, &$addresses) {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $addresses = array();
        
        $has_address = true;
        
        if(is_null($customer)) {
            $has_address = false;
        }
        
        if($has_address) {
            $addresses['billing'] = $customer->getPrimaryBillingAddress();
            $addresses['shipping'] = $customer->getPrimaryShippingAddress();
        }
    }
    
}
