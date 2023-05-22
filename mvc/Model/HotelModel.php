<?php

include 'Store/HotelStore.php';

class HotelModel extends HotelStore
{


    protected $table = "hotel_table";


    public function create_tables()
    {   
        $result = $this->create_table_hotels();
        return $result;
    }

    
    public function fill_tables() 
    {
      $result = $this->fill_table_hotels();
      return $result;
    }

    
}
