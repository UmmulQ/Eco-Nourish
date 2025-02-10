<?php
// Include the database connection file
include 'connection.php';

if (isset($_POST['dairy_id'])) {
    $dairy_id = $_POST['dairy_id'];
    $sql = "SELECT * FROM dairy WHERE Dairy_id = '$dairy_id'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        // Output the dairy product details
        echo "<h3>Waste:</h3><p>" . htmlspecialchars($row['waste']) . "</p>";

        // Display utilization as bullet points without the "•"
        if (!empty($row['utilization'])) {
            echo "<h3>Ways to Utilize:</h3><ul>";
            $utilizationPoints = explode("\n", $row['utilization']); // Split by new line
            foreach ($utilizationPoints as $point) {
                $point = trim($point);
                // Remove leading "•" if present
                $point = ltrim($point, '• ');
                if (!empty($point)) { 
                    echo "<li>" . htmlspecialchars($point) . "</li>";
                }
            }
            echo "</ul>";
        }

        echo "<h3>References:</h3><p>" . htmlspecialchars($row['reference']) . "</p>";

        // Show disclaimer only if it's not empty
        if (!empty(trim($row['disclaimer']))) {
            echo "<h3>Disclaimer:</h3><p>" . htmlspecialchars($row['disclaimer']) . "</p>";
        }
    } else {
        echo "No details found.";
    }
}

$conn->close();
?>
