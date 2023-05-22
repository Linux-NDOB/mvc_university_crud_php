
<?php

require_once ('DB/DB.php');

class UniversityStore {

    private $connection;

    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM university_table WHERE university_id = ?";
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
        $sql = "SELECT * FROM university_table";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create_table_university()
    {
        $sql = "create table if not exists university_table (
         university_id integer unsigned primary key,
         university_name varchar(200) unique not null,
         university_location varchar(200) unique not null
        )";
        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table university created';

    }

    public function update_university($array)
    { 
        $exists = $this->selectById($array['university_id']);

        if ($exists == null){
          return "The element doesn't exists";
        }

        $sql = "update university_table set 
         university_name='{$array['university_name']}',
         university_location='{$array['university_location']}'
         where university_id={$array['university_id']}";

        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table updated';

    }

    public function store_university($array)
    { 
        $exists = $this->selectById($array['university_id']);

        if ($exists !== null){
          $this->update_university($array); 
        }

        $sql = "insert into university_table (
         university_id ,
         university_name,
         university_location
        )
        values ( {$array['university_id']} , '{$array['university_name']}', '{$array['university_location']}' )";

        $stm = $this->connection->prepare($sql);
        $stm->execute();        
        $stm->fetchAll(PDO::FETCH_ASSOC);
        return 'Table updated of filled';

    }
    
    public function delete_university($array) {
      $sql = "delete from university_table
        where university_id = {$array['university_id']} ";
	    $stm = $this->connection->prepare($sql);
      $stm->execute();        
      $stm->fetchAll(PDO::FETCH_ASSOC);
	    return 'University Deleted';
	  }
}
