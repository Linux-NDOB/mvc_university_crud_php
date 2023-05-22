
<?php

require_once ('DB/DB.php');

class RoomStore {

    private $connection;

    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM room_table WHERE room_id = ?";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(1, $id);
        $stm->execute();
        $res = $stm->fetch();
        if ($res == false) {
            return null;
        }
        return $res;
    }

    public function all()
    {
        $sql = "SELECT * FROM room_table";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_room($array)
    { 
        $exists = $this->selectById($array['room_id']);

        if ($exists == null){
          return "The element doesn't exists";
        }

        $sql = "update room_table set 
         university_name = '{$array['university_name']}',
         room_type = '{$array['room_type']}'
         where room_id = {$array['room_id']}";

        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table succesfully updated';

    }


    public function create_table_room()
    {
        $sql = "create table if not exists room_table (
         room_id integer unsigned primary key,
         room_type varchar(100) not null,
         university_name varchar(100) unique not null
        )";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table room created';

    }
    
    public function store_room($array)
    { 
        $exists = $this->selectById($array['room_id']);

        if ($exists !== null){
          $this->update_room($array);
        }

        $sql = "insert into room_table (room_id, room_type, university_name) values ( {$array['room_id']}, '{$array['room_type']}', '{$array['university_name']}')";

        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Filled or updated succesfully';
    }

    
    public function delete_room($array) {
      $sql = "delete from room_table
        where room_id = {$array['room_id']} ";
	    $stm = $this->connection->prepare($sql);
      $stm->execute();        
      $stm->fetchAll(PDO::FETCH_ASSOC);
	    return 'Room Deleted';
	  }
}
