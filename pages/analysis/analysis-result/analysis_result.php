<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../navigation/navigation-bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../asset/css/analysis.css">
    <link rel="stylesheet" href="../../../asset/css/footer.css">
    <link rel="stylesheet" href="../../../asset/css/navigation.css">
    <link rel="stylesheet" href="../../../asset/css/drop_down_menu.css">
    <script src="analysis_result.js"></script>  
    <link rel="stylesheet" href="analysis_result.css">
    <title>Analyze Results</title>
</head>
<body>
    <!-- Navigation -->
    <?php include '../../../component/navigation/navigation.php'  ?>
    

    <!-- Header -->
    <section class="analysis-container">
        <div class="analysis">
            <h2 style="color:#89CFF0;">Analyze ingredients</h2>
            <h2>| Your analysis</h2>
        </div>
        <h2 style="margin-left: 100px;">Here's your analysis</h2>
    </section>

    <!-- Result Display -->
    <section class="analysis-results">
        <div class="result">
            <?php
            $matchPercentage = isset($_GET['matchPercentage']) ? floatval($_GET['matchPercentage']) : 0;
            $description = isset($_GET['description']) ? urldecode($_GET['description']) : 'No analysis available.';
            $matchedIngredients = isset($_GET['matchedIngredients']) ? json_decode(urldecode($_GET['matchedIngredients']), true) : [];
            ?>
            <h3><?php echo number_format($matchPercentage, 2); ?>%</h3>
            <p><?php echo htmlspecialchars($description); ?></p>
            <?php if (!empty($matchedIngredients)): ?>
                <p>Matched Ingredients: <?php echo htmlspecialchars(implode(', ', $matchedIngredients)); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../../../component/footer/footer.php' ?>
</body>
</html>