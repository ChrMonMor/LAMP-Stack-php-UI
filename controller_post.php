<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Include config file
        require_once "config.php";
        // Define variables and initialize with empty values
        $location = $ip = $type = "";
        $location_err = $ip_err = $type_err"";
        // Validate location
        $input_location = trim($_POST["location"]);
        if(empty($input_location)){
            $location_err = "Please enter a location.";
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
        $input_type = trim($_POST["type"]);
        if(empty($input_type)){
            $type_err = "Please enter a type.";
        } else{
            $type = $input_type;
        }
        // Check input errors before inserting in database
        if(empty($location_err) && empty($ip_err) && empty($type_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO controllers (location, ip, types) VALUES (:location, :ip, :types)";
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":location", $param_location);
                $stmt->bindParam(":ip", $param_ip);
                $stmt->bindParam(":type", $param_type);
                // Set parameters
                $param_location = $location;
                $param_ip = $ip;
                $param_type = $type;
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

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        require_once "config.php";
        $sql = "SELECT c.id as id, c.ip as ip, c.types as types, c.created_at as created_at, l.name as name FROM `controllers` c join locations l on l.id = c.location;";
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
    }
