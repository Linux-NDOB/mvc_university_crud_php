
<?php


require_once 'Model/UniversityModel.php';



class UniversityController
{

    private $university_model;


    public function __construct()
    {
        $this->university_model = new UniversityModel();
    }

    public function fetch()
    {      
        $data = $this->university_model->fetch();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function create()
    {      
        $data = $this->university_model->create_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function fill()
    {

        $data = $this->university_model->fill_tables();

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function store($array)
    {

        $data = $this->university_model->store($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function update($array)
    {

        $data = $this->university_model->update($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

    public function deletes($array)
    {

        $data = $this->university_model->deletes($array);

        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'answer' => $data
        ]);

    }

}
