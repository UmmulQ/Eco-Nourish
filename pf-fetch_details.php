<?php
// Start the session
session_start();

// Include the database connection file
include 'connection.php';

if (isset($_POST['pf_id'])) {
    $pf_id = $_POST['pf_id'];
    $sql = "SELECT * FROM processedfood WHERE pf_id = '$pf_id'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        echo "<h3>Waste:</h3><p>" . htmlspecialchars($row['waste']) . "</p>";

        // Display utilization as bullet points
        echo "<h3>Ways to Utilize Cereals:</h3><ul>";
        $utilization_points = explode("\n", $row['utilization']); // Split by new line
        foreach ($utilization_points as $point) {
            $point = trim($point); // Remove extra spaces
            if (strpos($point, '-') === 0) { // Check if it starts with '-'
                echo "<li>" . htmlspecialchars(substr($point, 1)) . "</li>"; // Remove the '-' before displaying
            }
        }
        echo "</ul>";

        // Display references as bullet points
        echo "<h3>References: </h3><p>" . $row['reference'] . "</p>";
        
        // Display disclaimer only if it's not empty
        if (!empty(trim($row['disclaimer']))) {
            echo "<h3>Disclaimer:</h3><p>" . htmlspecialchars($row['disclaimer']) . "</p>";
        }
    } else {
        echo "No details found.";
    }
}

$conn->close();
?>
