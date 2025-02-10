<?php
// Include the database connection file
include 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fruit Information</title>
    <link rel="stylesheet" href="p-food.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="title">Select a Fruit</h2>
        <select id="fruit" class="dropdown" onchange="fetchFruitDetails()">
            <option value="">Select a fruit</option>
            <?php
            $sql = "SELECT fruit_id, commodity_name FROM fruits";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['fruit_id'] . "'>" . $row['commodity_name'] . "</option>";
            }
            ?>
        </select>

        <div id="fruit-details" class="details-box"></div>
    </div>

    <script>
        function fetchFruitDetails() {
            var fruit_id = document.getElementById("fruit").value;
            if (fruit_id === "") {
                document.getElementById("fruit-details").innerHTML = "";
                return;
            }
            
            $.ajax({
                url: "fruits-fetch_details.php",
                type: "POST",
                data: { fruit_id: fruit_id },
                success: function(response) {
                    $("#fruit-details").html(response);
                }
            });
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
<!-- <?php include 'footer.php'; ?> -->
