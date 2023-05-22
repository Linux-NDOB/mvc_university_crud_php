
<?php

include 'Store/RoomStore.php';

class RoomModel extends RoomStore
{


    protected $table = "room_table";


    public function create_tables()
    {   
        $result = $this->create_table_room();
        return $result;
    }

    
    public function store($array) 
    {
      $result = $this->store_room($array);
      return $result;
    }

    public function update($array) 
    {
      $result = $this->update_room($array);
      return $result;
    }

    public function deletes($id) 
    {
      $result = $this->delete_room($id);
      return $result;
    }

    
}
