<?php
    require_once "config.php";

    // Setting varibles by group
    $temperature = $temperature_low = $temperature_high = $temperature_low_after = $temperature_high_after = "";
    $humidity = $humidity_medium = $humidity_high = $humidity_medium_after = $humidity_high_after = "";
    $noise = $noise_medium = $noise_high = "";
    $airquality = $airquality_medium = $airquality_high = "";
    $start_time = $end_time = $after_time = "";
    // Prepare a select statement
    $sql = "SELECT * FROM timers WHERE id = 1";

    if($stmt = $pdo->prepare($sql)){
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                // Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop 
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $temperature = $row["temperature"];
                $temperature_low = $row["temperature_low"];
                $temperature_high = $row["temperature_high"];
                $temperature_low_after = $row["temperature_low_after"];
                $temperature_high_after = $row["temperature_high_after"];
                $humidity = $row["humidity"];
                $humidity_medium = $row["humidity_medium"];
                $humidity_high = $row["humidity_high"];
                $humidity_medium_after = $row["humidity_medium_after"];
                $humidity_high_after = $row["humidity_high_after"];
                $noise = $row["noise"];
                $noise_medium = $row["noise_medium"];
                $noise_high = $row["noise_high"];
                $airquality = $row["airquality"];
                $airquality_medium = $row["airquality_medium"];
                $airquality_high = $row["airquality_high"];
                $start_time = $row["start_time"];
                $end_time = $row["end_time"];
                $after_alarm = $row["after_alarm"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);


    echo '<h2>Add New Contoller</h2>
        <form action="/new_page.php" method="post">
            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location"><br>
            <label for="ip">IP-adress:</label><br>
            <input type="text" id="ip" name="ip"><br>
            <input type="submit" value="Submit">
        </form> ';

    echo '<h2>Update Contoller Timers</h2>
        <form action="/update_page.php" method="post">
        <div style="display: flex; justify-content: center; text-align: center;">
        <div>
            <label for="temperature">Temperatur Timer:</label><br>
            <input type="number" id="temperature" name="temperature" min="1" max="5000" value="'.$temperature.'" required><br>
            <ul style="list-style-type: none;">
                <li>
                    <label for="temperature_low">Temperatur Low Mark:</label><br>
                    <input type="number" id="temperature_low" name="temperature_low" min="1" max="5000" value="'.$temperature_low.'" required>
                </li>
                <li>
                    <label for="temperature_high">Temperatur High Mark:</label><br>
                    <input type="number" id="temperature_high" name="temperature_high" min="1" max="5000" value="'.$temperature_high.'" required>
                </li>
                <li>
                    <label for="temperature_low_after">Temperatur Low Mark After Hours:</label><br>
                    <input type="number" id="temperature_low_after" name="temperature_low_after" min="1" max="5000" value="'.$temperature_low_after.'" required>
                </li>
                <li>
                    <label for="temperature_high_after">Temperatur High Mark After Hours:</label><br>
                    <input type="number" id="temperature_high_after" name="temperature_high_after" min="1" max="5000" value="'.$temperature_high_after.'" required>
                </li>
            </ul>
        </div>
        <div>
            <label for="humidity">Luftfugtighed Timer:</label><br>
            <input type="number" id="humidity" name="humidity" min="1" max="5000" value="'.$humidity.'" required><br>
            <ul style="list-style-type: none;">
                <li>
                    <label for="humidity_medium">Luftfugtighed Low Mark:</label><br>
                    <input type="number" id="humidity_medium" name="humidity_medium" min="1" max="100" value="'.$humidity_medium.'" required>
                </li>
                <li>
                    <label for="humidity_high">Luftfugtighed High Mark:</label><br>
                    <input type="number" id="humidity_high" name="humidity_high" min="1" max="100" value="'.$humidity_high.'" required>
                </li>
                <li>
                    <label for="humidity_medium_after">Luftfugtighed Low Mark After Hours:</label><br>
                    <input type="number" id="humidity_medium_after" name="humidity_medium_after" min="1" max="100" value="'.$humidity_medium_after.'" required>
                </li>
                <li>
                    <label for="humidity_high_after">Luftfugtighed High Mark After Hours:</label><br>
                    <input type="number" id="humidity_high_after" name="humidity_high_after" min="1" max="100" value="'.$humidity_high_after.'" required>
                </li>
            </ul>
        </div>
        <div>
            <label for="noise">Støj Timer:</label><br>
            <input type="number" id="noise" name="noise" min="1" max="5000" value="'.$noise.'" required><br>
            <ul style="list-style-type: none;">
                <li>
                    <label for="noise_medium">Støj Low Mark:</label><br>
                    <input type="number" id="noise_medium" name="noise_medium" min="1" max="100" value="'.$noise_medium.'" required>
                </li>
                <li>
                    <label for="noise_high">Støj High Mark:</label><br>
                    <input type="number" id="noise_high" name="noise_high" min="1" max="100" value="'.$noise_high.'" required>
                </li>
            </ul>
        </div>
        <div>
            <label for="airquality">Luftkvalitet Timer:</label><br>
            <input type="number" id="airquality" name="airquality" min="1" max="5000" value="'.$airquality.'" required><br>
            <ul style="list-style-type: none;">
                <li>
                    <label for="airquality_medium">Støj Low Mark:</label><br>
                    <input type="number" id="airquality_medium" name="airquality_medium" min="1" max="100" value="'.$airquality_medium.'" required>
                </li>
                <li>
                    <label for="airquality_high">Støj High Mark:</label><br>
                    <input type="number" id="airquality_high" name="airquality_high" min="1" max="100" value="'.$airquality_high.'" required>
                </li>
            </ul>
            
        </div>
        <div>
            <label for="start_time">Arbejdesdag Starter kl.:</label><br>
            <input type="text" id="start_time" name="start_time" min="1" max="5000" value="'.$start_time.'" required><br>
            <label for="end_time">Arbejdesdag Slutter kl.:</label><br>
            <input type="text" id="end_time" name="end_time" min="1" max="5000" value="'.$end_time.'" required><br>
            <label for="after_alarm">Skal Alarmen køre efter arbejdstider:</label><br>
            <input type="radio" id="after_alarm" name="after_alarm" min="0" max="1"  value="'.$after_alarm.'" required><br>
        </div>
            <input type="submit" value="Submit">
        </div>
        </form> ';
    
?>
