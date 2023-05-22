<?php




// Include CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'Controller/HotelController.php';
require_once 'config/config.php';

// Create tables and fill hotel table

// 1. Validar la existencia del parametro 'controller'
// ...

$nameController = ucfirst($_GET['controller']).'Controller'; 
$pathController = 'Controller/' . $nameController . '.php';


// 2. Validar la existencia del archivo
// ...

// 3. Validar la existencia del parámetro 'action'
// ..
$action = $_GET['action'];

require_once $pathController;

$controller = new $nameController();
//$controller->$action();

function clean($data) {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
}

if ($nameController == 'HotelController'){

  $controller->$action();

} elseif ($nameController === 'UniversityController' and ($action === 'create' or $action ==='list' or $action === 'fetch')){

  $controller->$action();

} elseif ($nameController === 'UniversityController' and ($action !== 'create' and $action !=='list' and $action !== 'fetch')){

  $array = [
    'university_id' => clean($_GET['university_id']),
    'university_name' => clean($_GET['university_name']),
    'university_location' => clean($_GET['university_location']),
  ];

  $controller->$action($array);

} elseif ($nameController === 'RoomController' and ($action === 'create' or $action ==='list' or $action === 'fetch')){

  $controller->$action();

} elseif ($nameController === 'RoomController' and ($action !== 'create' and $action !=='list' and $action !== 'fetch')){

  $array = [
    'room_id' => clean($_GET['room_id']),
    'university_name' => clean($_GET['university_name']),
    'room_type' => clean($_GET['room_type']),
  ];

  $controller->$action($array);
} 
