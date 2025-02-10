<?php
// Include the database connection file
include 'connection.php';

if (isset($_POST['veg_id'])) {
    $veg_id = $_POST['veg_id'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM vegetables WHERE Veg_id = ?");
    $stmt->bind_param("s", $veg_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Output the vegetable details
        echo "<h3>Waste:</h3><p>" . htmlspecialchars($row['waste']) . "</p>";

        // Process utilization field to replace '•' with bullet points
        $utilization = htmlspecialchars($row['utilization']); 
        $utilization = preg_replace('/•\s*/', '<li>', $utilization); // Replace '•' with <li>
        $utilization = "<ul>" . str_replace("\n", "</li>\n", $utilization) . "</li></ul>"; // Wrap in <ul>

        echo "<h3>Ways to Utilize:</h3>" . $utilization;
        echo "<h3>References:</h3><p>" . htmlspecialchars($row['reference']) . "</p>";
        echo "<h3>Disclaimer:</h3><p>" . htmlspecialchars($row['disclaimer']) . "</p>";
    } else {
        echo "No details found.";
    }

    $stmt->close();
}

$conn->close();
?>
