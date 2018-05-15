<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Month_schedule extends CI_Model {

    public function get_batch_plans($month = null) {
        date_default_timezone_set('Asia/Kolkata');
        
        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/get_batch_plans';
        if(isset($month))
            $url = $url.'?batch_plan_date='.$month;

        //  Setting URL To Fetch Data From
        $this->curl->create($url);

        //  To Temporarily Store Data Received From Server
        $this->curl->option('buffersize', 10);

        //  To Receive Data Returned From Server
        $this->curl->option('returntransfer', 1);

        //  To follow The URL Provided For Website
        $this->curl->option('followlocation', 1);

        //  To Retrieve Server Related Data
        $this->curl->option('HEADER', false);

        //  To Set Time For Process Timeout
        $this->curl->option('connecttimeout', 600);

        //  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
        $data = $this->curl->execute();

        $decode_data = json_decode($data, true);
        //echo '<pre>';print_r($decode_data);die();
        
        return $decode_data;
    }
    
    public function get_inventories($month = null) {
        $url = 'http://172.16.0.22:1313/api/v1/inventories/get_inventories';
        if(isset($month))
            $url = $url.'?inventory_date='.$month;
        
        //  Setting URL To Fetch Data From
        $this->curl->create($url);

        //  To Temporarily Store Data Received From Server
        $this->curl->option('buffersize', 10);

        //  To Receive Data Returned From Server
        $this->curl->option('returntransfer', 1);

        //  To follow The URL Provided For Website
        $this->curl->option('followlocation', 1);

        //  To Retrieve Server Related Data
        $this->curl->option('HEADER', false);

        //  To Set Time For Process Timeout
        $this->curl->option('connecttimeout', 600);

        //  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
        $data = $this->curl->execute();

        $decode_data = json_decode($data);
//        echo '<pre>';print_r($url);die();

        return $decode_data;
    }

}
