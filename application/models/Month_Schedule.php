<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Month_schedule extends CI_Model {

    public function get_batch_plans($month = null) {
        date_default_timezone_set('Asia/Kolkata');

        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/get_batch_plans';
        if (isset($month))
            $url = $url . '?batch_plan_date=' . $month;

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
        if (isset($month))
            $url = $url . '?inventory_date=' . $month;

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

    public function get_generate_batch_plan() {
        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/generate_batch_plan';
        $responce = $this->postCURL($url, array());
        $decode_data = json_decode($responce);
        return $decode_data;
    }

    public function postCURL($_url, $_param) {

        $postData = '';
        //create name value pairs seperated by &
        foreach ($_param as $k => $v) {
            $postData .= $k . '=' . $v . '&';
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }

    public function publish_batch_plan() {
        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/publish_batch_plan';
        $responce = $this->postCURL($url, array());
        echo $responce;
    }

    public function unpublish_batch_plan() {
        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/unpublish_batch_plan';
        $responce = $this->postCURL($url, array());
        echo $responce;
    }

    public function update_nobatch($get_nobatch = null) {
        $uuid = $get_nobatch['prod_uuid'];
        $number_of_batches = $get_nobatch['prod_batch'];
        $data = array('uuid' => $uuid, 'number_of_batches' => $number_of_batches);
        $url = 'http://172.16.0.22:1313/api/v1/batch_plans/update_batch_plan';
        $responce = $this->postCURL($url, $data);
        $decode_data = json_decode($responce);
        return $decode_data;
    }

}
