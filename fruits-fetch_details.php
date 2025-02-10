<?php
// Start the session
session_start();

// Include the database connection file
include 'connection.php';

if (isset($_POST['fruit_id'])) {
    $fruit_id = $_POST['fruit_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM fruits WHERE fruit_id = ?");
    $stmt->bind_param("s", $fruit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<h3>Waste:</h3><p>" . htmlspecialchars($row['waste']) . "</p>";

        // Process utilization field to replace '-' and '.' with bullet points
        $utilization = htmlspecialchars($row['utilization']);
        $utilization = preg_replace('/^[-.]\s*/m', '<li>', $utilization); // Replace '-' or '.' at the beginning
        $utilization = "<ul>" . str_replace("\n", "</li>\n", trim($utilization)) . "</li></ul>"; // Wrap in <ul>

        echo "<h3>Ways to Utilize:</h3>" . $utilization;

        // Display "References" only if it is not empty
        if (!empty(trim($row['reference']))) {
            echo "<h3>References:</h3><p>" . htmlspecialchars($row['reference']) . "</p>";
        }

        // Display "Disclaimer" only if it is not empty
        if (!empty(trim($row['disclaimer']))) {
            echo "<h3>Disclaimer:</h3><p>" . htmlspecialchars($row['disclaimer']) . "</p>";
        }
    } else {
        echo "No details found.";
    }

    $stmt->close();
}

$conn->close();
?>
