<?php
// Include the database connection file
include 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dairy Products</title>
    <link rel="stylesheet" href="p-food.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="title">Select a Dairy Product</h2>
        <select id="commodity" class="dropdown" onchange="fetchDetails()">
            <option value="">Select a dairy product</option>
            <?php
            // SQL query to fetch dairy products from the database
            $sql = "SELECT Dairy_id, commodity_name FROM dairy";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Dairy_id'] . "'>" . $row['commodity_name'] . "</option>";
            }
            ?>
        </select>

        <div id="details" class="details-box"></div>
    </div>

    <script>
        function fetchDetails() {
            var dairy_id = document.getElementById("commodity").value;
            if (dairy_id === "") {
                document.getElementById("details").innerHTML = "";
                return;
            }
            
            $.ajax({
                url: "dairy-fetch_details.php",
                type: "POST",
                data: { dairy_id: dairy_id },
                success: function(response) {
                    $("#details").html(response);
                }
            });
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
<!-- <?php include 'footer.php'; ?> -->
