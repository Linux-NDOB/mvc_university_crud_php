
<?php


require_once 'Model/RoomModel.php';



class RoomController
{

    private $room_model;


    public function __construct()
    {
        $this->room_model = new RoomModel();
    }


    public function create()
    {      
        $data = $this->room_model->create_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function fetch()
    {

        $data = $this->room_model->fetch();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function fill()
    {

        $data = $this->room_model->fill_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function store($array)
    {

        $data = $this->room_model->store($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function update($array)
    {

        $data = $this->room_model->update($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function deletes($array)
    {

        $data = $this->room_model->deletes($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

}
