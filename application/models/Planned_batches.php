<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Planned_batches extends CI_Model {

    public function resequence_planned_batches() {
        //  Setting URL To Fetch Data From
        $this->curl->create('http://172.16.20.19:3000/api/v1/batch_plans/get_planned_batches');

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
        //echo '<pre>';print_r($decode_data);die();
        
        return $decode_data;
    }

}
