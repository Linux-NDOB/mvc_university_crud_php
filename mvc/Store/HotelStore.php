<?php

require_once ('DB/DB.php');

class HotelStore {

    private $connection;

    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM hotel_table WHERE hotel_id = ?";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(1, $id);
        $stm->execute();
        $res = $stm->fetch();
        if ($res == false) {
            return null;
        }
        return $res;
    }


    public function create_table_hotels()
    {
        $sql = "create table if not exists hotel_table (
         hotel_id integer unsigned primary key auto_increment,
         hotel_name varchar(100) not null,
         hotel_halls integer unsigned not null
        )";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table created';

    }
    
    public function fill_table_hotels()
    {
        $array = [
          'hotel_name' => 'HOTEL REAL',
          'hotel_halls' => 50,
        ];

        $exists = $this->selectById(1);

        if ($exists !== null){
          return  $array ;
        }

        $sql = "insert into hotel_table (
         hotel_id ,
         hotel_name ,
         hotel_halls 
        )
        values (1, 'HOTEL REAL', 50)";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
        return $array;

    }

}
