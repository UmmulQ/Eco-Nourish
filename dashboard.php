
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Nourish</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <?php include 'header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Eco Nourish</h2>
            <h1>Revolutionize Leftover</h1>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <h2>About Our Mission</h2>
        <p>At Eco Nourish, we are committed to reducing food waste and promoting sustainability. 
            Our platform provides innovative solutions to help individuals and businesses repurpose 
            food leftovers into new, valuable products. Whether it's transforming surplus ingredients 
            into nutritious meals or reusing waste for eco-friendly purposes, Eco Nourish is at the forefront of 
            revolutionizing how we think about leftovers.</p>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="category-box">
            <a href="process_food.php">
            <i class="fas fa-utensils"></i>
            <h3>Process Food</h3>
        </div>
        <div class="category-box">
            <a href="fruits.php">
            <i class="fas fa-apple-alt"></i>
            <h3>Fruits</h3>
        </div>
        <div class="category-box">
            <a href="vegetable.php">
            <i class="fas fa-carrot"></i>
            <h3>Vegetable</h3>
        </div>
        <div class="category-box">
            <a href="dairy_products.php">
            <i class="fas fa-cheese"></i>
            <h3>Dairy Products</h3>
        </div>
        <div class="category-box">
            <a href="coffee_tea.php">
            <i class="fas fa-coffee"></i>
            <h3>Coffee/Tea</h3>
        </div>
    </section>


    <!-- Footer Section -->
    <?php include 'footer.php'; ?>
</body>
</html>

