<?php
function validateData($input) : String {
    $output = "";
    if(empty($input)){
        header("location: error.php");
        exit();
    } else{
        $output = $input;
    }
    return $output;
}
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Include config file
        require_once "config.php";
        
        // Define variables and initialize with empty values
        $temperature = $temperature_low = $temperature_high = $temperature_low_after = $temperature_high_after = "";
        $humidity = $humidity_medium = $humidity_high = $humidity_medium_after = $humidity_high_after = "";
        $noise = $noise_medium = $noise_high = "";
        $airquality = $airquality_medium = $airquality_high = "";
        $start_time = $end_time = $after_time = "";

        // Get hidden input value
        $id = 1;
        
        // Validates all params 
        $temperature = validateData(trim($_POST["temperature"]));
        $temperature_low = validateData(trim($_POST["temperature_low"]));
        $temperature_high = validateData(trim($_POST["temperature_high"]));
        $temperature_low_after = validateData(trim($_POST["temperature_low_after"]));
        $temperature_high_after = validateData(trim($_POST["temperature_high_after"]));
        $humidity = validateData(trim($_POST["humidity"]));
        $humidity_medium = validateData(trim($_POST["humidity_medium"]));
        $humidity_high = validateData(trim($_POST["humidity_high"]));
        $humidity_medium_after = validateData(trim($_POST["humidity_medium_after"]));
        $humidity_high_after = validateData(trim($_POST["humidity_high_after"]));
        $noise = validateData(trim($_POST["noise"]));
        $noise_medium = validateData(trim($_POST["noise_medium"]));
        $noise_high = validateData(trim($_POST["noise_high"]));
        $airquality = validateData(trim($_POST["airquality"]));
        $airquality_medium = validateData(trim($_POST["airquality_medium"]));
        $airquality_high = validateData(trim($_POST["airquality_high"]));
        $start_time = validateData(trim($_POST["start_time"]));
        $end_time = validateData(trim($_POST["end_time"]));
        $after_time = validateData(trim($_POST["after_time"]));
        
            // Prepare an update statement
            $sql = "UPDATE timers SET 
            temperature=:temperature, temperature_low=:temperature_low, temperature_high=:temperature_high
            temperature_low_after=:temperature_low_after, temperature_high_after=:temperature_high_after, 
            humidity=:humidity humidity_medium=:humidity_medium, humidity_high=:humidity_high, 
            humidity_medium_after=:humidity_medium_after humidity_high_after=:humidity_high_after, 
            noise=:noise, noise_medium=:noise_medium noise_high=:noise_high, 
            airquality=:airquality, airquality_medium=:airquality_medium airquality_high=:airquality_high, 
            start_time=:start_time, end_time=:end_time after_time=:after_time WHERE id=:id";
    
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":temperature", $temperature);
                $stmt->bindParam(":temperature_low", $param_address);
                $stmt->bindParam(":temperature_high", $param_salary);
                $stmt->bindParam(":temperature_low_after", $temperature_low_after);
                $stmt->bindParam(":temperature_high_after", $temperature_high_after);
                $stmt->bindParam(":humidity", $humidity);
                $stmt->bindParam(":humidity_medium", $humidity_medium);
                $stmt->bindParam(":humidity_high", $humidity_high);
                $stmt->bindParam(":humidity_medium_after", $humidity_medium_after);
                $stmt->bindParam(":humidity_high_after", $humidity_high_after);
                $stmt->bindParam(":noise", $noise);
                $stmt->bindParam(":noise_medium", $noise_medium);
                $stmt->bindParam(":noise_high", $noise_high);
                $stmt->bindParam(":airquality", $airquality);
                $stmt->bindParam(":airquality_medium", $airquality_medium);
                $stmt->bindParam(":airquality_high", $airquality_high);
                $stmt->bindParam(":start_time", $start_time);
                $stmt->bindParam(":end_time", $end_time);
                $stmt->bindParam(":after_time", $after_time);
                $stmt->bindParam(":id", $param_id);
                
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Records updated successfully. Redirect to landing page
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
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();

?>