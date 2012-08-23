RedFeet_Location
================

Magento module para adicionar Estados/Cidades brasileiros.

Exemplo básico de uso dos blocos Country, Region, City:
<?= $this->getLayout()->createBlock('location/country')->setId('contacts_country_id')->setName('contacts[country_id]')->html(); ?>
<?= $this->getLayout()->createBlock('location/region')->setId('contacts_region_id')->setName('contacts[region_id]')->html(); ?>
<?= $this->getLayout()->createBlock('location/city')->setId('contacts_city')->setName('contacts[city]')->html(); ?>


Exemplo de uso Checkout Billing:
<?= $this->getLayout()->createBlock('location/country')->setId('billing_country_id')->setName('billing[country_id]')->setType('billing')->html(); ?>
<?= $this->getLayout()->createBlock('location/region')->setId('billing_region_id')->setName('billing[region_id]')->setType('billing')->html(); ?>
<?= $this->getLayout()->createBlock('location/city')->setId('billing_city')->setName('billing[city]')->setType('billing')->html(); ?>

Exemplo de uso na pagina Address Edit:
<?= $this->getLayout()->createBlock('location/country')->setId('country_id')->setName('country_id')->setValue($this->getCountryId())->html(); ?>
<?= $this->getLayout()->createBlock('location/region')->setId('region_id')->setName('region_id')->setValue($this->getRegionId())->html(); ?>
<?= $this->getLayout()->createBlock('location/city')->setId('city')->setName('city')->setValue($this->getAddress()->getCity())->setRegionId($this->getRegionId())->html(); ?>