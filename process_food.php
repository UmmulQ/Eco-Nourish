<?php
// Include the database connection file
include 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Processed Food</title>
    <link rel="stylesheet" href="p-food.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="title">Select a Commodity</h2>
        <select id="commodity" class="dropdown" onchange="fetchDetails()">
            <option value="">Select a commodity</option>
            <?php
            $sql = "SELECT pf_id, commodity_name FROM processedfood";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['pf_id'] . "'>" . $row['commodity_name'] . "</option>";
            }
            ?>
        </select>

        <div id="details" class="details-box"></div>
    </div>

    <script>
        function fetchDetails() {
            var pf_id = document.getElementById("commodity").value;
            if (pf_id === "") {
                document.getElementById("details").innerHTML = "";
                return;
            }
            
            $.ajax({
                url: "pf-fetch_details.php",
                type: "POST",
                data: { pf_id: pf_id },
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