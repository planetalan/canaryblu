<?php

class Application_Form_Marketdata extends Zend_Form
{

    public function init()
    {
       $this->setName('marketdata');
       $date = new Zend_Form_Element_Hidden('date');
       $price = new Zend_Form_Element_Hidden('price');
       $amount = new Zend_Form_Element_Hidden('amount');
       $currency = new Zend_Form_Element_Hidden('currency');
       $exchange = new Zend_Form_Element_Hidden('exchange');
    }


}

