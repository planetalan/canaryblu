<?php

class Application_Model_DbTable_Marketdata extends Zend_Db_Table_Abstract
{

    protected $_name = 'marketdata';

    public function addMarketdata($date, $price,$amount,$currency,$exchange)
    {
        $data = array(
            'date' => $date,
            'price' => $price,
            'amount' => $amount,
            'currency' => $currency,
            'exchange' => $exchange,
        );
        $this->insert($data);
    }

    public function get_last()
    {
        $sql = 'SELECT max(date) FROM marketdata';
        $query = $this->getAdapter()->query($sql);
        $result = $query->fetchAll();
        return $result[0]['max(date)'];
    }


}

