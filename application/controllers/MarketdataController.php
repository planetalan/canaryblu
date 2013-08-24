<?php

class MarketdataController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $marketdataset = new Application_Model_DbTable_Marketdata();
        $this->view->marketdataset = $marketdataset->fetchAll();
    }

    public function fetchAction()
    {
        // connect to bitcoin charts API
        $jsonurl = "http://api.bitcoincharts.com/v1/markets.json";
        $json = file_get_contents($jsonurl,0,null,null);
        $json_output = json_decode($json);
        $this->view->json_output = json_decode($json);

        //retrieve latest 20000 trades from the bitcoinchart csv file
        //connect to URL and put contents in a variable
        $url = "http://api.bitcoincharts.com/v1/trades.csv?symbol=mtgoxUSD";

        //put the contents into a string value
        $content = file_get_contents($url);

        //make each entry its own array value
        $line = explode("\n", $content);

        echo count($line). " records<BR><BR>";
        //check the db table for newest datestamp
        $db = new Application_Model_DbTable_Marketdata();
        $latest_date = $db->get_last();
        echo "the latest date is ".$latest_date;

        //loop over each row and create an array of those values
        foreach($line as $lineItem){

            $details = explode(",", $lineItem);
            echo "<hr>date ".gmdate("Y-m-d H:i:s", $details[0]);;
            $date = gmdate("Y-m-d H:i:s", $details[0]);
            echo "<br>price ".$details[1];
            echo "<br>amount".$details[2];

            //if this date is greater than the datestamp, insert into db
            if($date > $latest_date){
                echo "<h1>".$date." > ".$latest_date."</h1>";
                $db->addMarketdata($date,$details[1],$details[2],'USD','mtgox');
                echo "<h1>ADDED TO DB</h1>";
            }
            else {
                echo "<h1>NOT ADDED TO DB</h1>";
            }

        }


    }

    public function viewAction()
    {
        // action body
    }


}





