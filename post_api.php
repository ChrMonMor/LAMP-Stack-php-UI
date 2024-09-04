<?php

require_once "config.php";

$sql = "SELECT * FROM timers ";
$data = [];

try {
    $stmt = $pdo->query($sql);
        
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $data[] = $row;

    }
        
    echo json_encode($data);

} catch (Exception $ex) {

    echo json_encode($ex->getMessage());

} finally {
        
    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);

}

 
?>