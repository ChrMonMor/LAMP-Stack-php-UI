<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$location = $ip = "";
$location_err = $ip_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate location
    $input_location = trim($_POST["location"]);
    if(empty($input_location)){
        $location_err = "Please enter a location.";
    } elseif(!filter_var($input_location, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $location_err = "Please enter a valid location.";
    } else{
        $location = $input_location;
    }
    
    // Validate ip
    $input_ip = trim($_POST["ip"]);
    if(empty($input_ip)){
        $ip_err = "Please enter an ip.";     
    } else{
        $ip = $input_ip;
    }
    
    // Check input errors before inserting in database
    if(empty($location_err) && empty($ip_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO controllers (location, ip) VALUES (:location, :ip)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":location", $param_location);
            $stmt->bindParam(":ip", $param_ip);
            
            // Set parameters
            $param_location = $location;
            $param_ip = $ip;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                header("location: error.php");
                exit();
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
header("location: index.php");
exit()
?>