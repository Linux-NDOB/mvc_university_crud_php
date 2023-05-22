<?php


require_once 'Model/HotelModel.php';



class HotelController
{

    private $hotel_model;


    public function __construct()
    {
        $this->hotel_model = new HotelModel();
    }


    public function create()
    {      
        $data = $this->hotel_model->create_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function fill()
    {

        $data = $this->hotel_model->fill_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }
    
}
