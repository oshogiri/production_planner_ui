<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Model {

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
//        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }
    
    public function get_batch_plan_by_product($get_product = null) {
//        print_r($get_product);die();
        $url = $this->config->item('api_Address').'/api/v1/schedules/get_schedule_by_product_batch_number';
        $responce = $this->postCURL($url, $get_product);
        $decode_data = json_decode($responce);
        return $decode_data;
    }
    
    public function get_batch_plan_by_batch_number($get_batch_number = null) {
//        print_r($get_product);die();
        $data = array('batch_number' => $get_batch_number);
        $url = $this->config->item('api_Address').'/api/v1/schedules/get_schedule_by_product_batch_number';
        $responce = $this->postCURL($url, $data);
        $decode_data = json_decode($responce);
//        print_r($decode_data);        die();
        return $decode_data;
    }
    
    public function get_batch_number() {
        $this->curl->create($this->config->item('api_Address').'/api/v1/schedules/send_batch_number');

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
//        echo '<pre>';print_r($decode_data);die();
        return $decode_data;
    }

}
