<?php

//require(APPPATH . '/libraries/rest.php');

class API extends CI_Controller {

    public function get_planned_batches() {

        $data = array(
            'uuid' => '8e54dcffe9cfbccd0eac47e3',
            'product' => 'DMAX',
            'batch_number' => '00'
        );

        //decode json data($encode_data) to array, using json_decode()
        $encode_data = json_encode($data);
        echo $encode_data;

        //decode json data($encode_data) to array, using json_decode()
//        $decode_data = json_decode($encode_data);
//        foreach ($decode_data as $value) {
//            echo $value . "<br>";
//        }
    }

    public function set_batch_number() {

        $data = array(
            'success' => true,
            'message' => 'Batch number updated successfully',
            'batch' => array(
                'uuid' => 'e0b4cbddc48dcd88de7de8f1',
                'product' => 'DMAX',
                'batch_number' => '10'
            )
        );

        //decode json data($encode_data) to array, using json_decode()
        $encode_data = json_encode($data);
        echo $encode_data;

        //decode json data($encode_data) to array, using json_decode()
//        $decode_data = json_decode($encode_data);
//        foreach ($decode_data as $value) {
//            echo $value . "<br>";
//        }
    }

}
