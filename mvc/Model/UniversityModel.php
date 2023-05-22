<?php

include 'Store/UniversityStore.php';

class UniversityModel extends UniversityStore
{


    protected $table = "university_table";


    public function create_tables()
    {   
        $result = $this->create_table_university();
        return $result;
    }

    public function fetch() 
    {
      $result = $this->all();
      return $result;
    }

    public function store($array) 
    {
      $result = $this->store_university($array);
      return $result;
    }

    public function update($array) 
    {
      $result = $this->update_university($array);
      return $result;
    }

    public function deletes($id) 
    {
      $result = $this->delete_university($id);
      return $result;
    }

    
}
