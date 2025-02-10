<?php
// Include the database connection file
include 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coffee/Tea</title>
    <link rel="stylesheet" href="p-food.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="title">Select a Tea Product</h2>
        <select id="commodity" class="dropdown" onchange="fetchDetails()">
            <option value="">Select a tea product</option>
            <?php
            // SQL query to fetch tea products from the database
            $sql = "SELECT Tea_id, commodity_name FROM tea";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Tea_id'] . "'>" . $row['commodity_name'] . "</option>";
            }
            ?>
        </select>

        <div id="details" class="details-box"></div>
    </div>

    <script>
        function fetchDetails() {
            var tea_id = document.getElementById("commodity").value;
            if (tea_id === "") {
                document.getElementById("details").innerHTML = "";
                return;
            }
            
            $.ajax({
                url: "tea-fetch_details.php",
                type: "POST",
                data: { tea_id: tea_id },
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
