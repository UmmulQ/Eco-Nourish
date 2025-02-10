<?php
// Include the database connection file
include 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vegetables</title>
    <link rel="stylesheet" href="p-food.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="title">Select a Vegetable</h2>
        <select id="vegetable" class="dropdown" onchange="fetchVegetableDetails()">
            <option value="">Select a vegetable</option>
            <?php
            $sql = "SELECT Veg_id, commodity_name FROM vegetables";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Veg_id'] . "'>" . $row['commodity_name'] . "</option>";
            }
            ?>
        </select>

        <div id="vegetable-details" class="details-box"></div>
    </div>

    <script>
        function fetchVegetableDetails() {
            var veg_id = document.getElementById("vegetable").value;
            if (veg_id === "") {
                document.getElementById("vegetable-details").innerHTML = "";
                return;
            }
            
            $.ajax({
                url: "vegetables-fetch_details.php",
                type: "POST",
                data: { veg_id: veg_id },
                success: function(response) {
                    $("#vegetable-details").html(response);
                }
            });
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
<!-- <?php include 'footer.php'; ?> -->
