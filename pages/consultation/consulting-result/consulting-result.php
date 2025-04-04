<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../../asset/css/consulting-result.css">
    <link rel="stylesheet" href="../../asset/global-style/product-recomend.css">
    <link rel="stylesheet" href="../../../asset/css/navigation.css">
    <link rel="stylesheet" href="../../../asset/css/footer.css">
    <link rel="stylesheet" href="../../../asset/css/drop_down_menu.css">
    <title>Consultation Results</title>
</head>
<body>
    <?php include '../../../component/navigation/navigation.php'; ?>

    <?php
    // Start the session or handle POST data
    if (isset($_POST['recommendation_data'])) {
        $data = json_decode($_POST['recommendation_data'], true);
    } else {
        $data = null;
    }
    ?>

    <div class="message-title">
        <div class="message">Your skin type is</div>
        <div class="underline"></div>
    </div>

    <div class="explaination">
        <?php if ($data): ?>
            <p style="text-align: center; font-size: 20px; font-weight: 600; color: #444;">
                Skin Type: <?php echo htmlspecialchars($data['skin_type']); ?><br>
                Acne Severity: <?php echo htmlspecialchars($data['acne_severity']); ?><br>
                Dark Spots Severity: <?php echo htmlspecialchars($data['dark_spots_severity']); ?><br>
                Large Pores Severity: <?php echo htmlspecialchars($data['large_pores_severity']); ?>
            </p>
        <?php else: ?>
            <p>No consultation data available.</p>
        <?php endif; ?>
    </div>

    <section class="results-container">
        <?php if ($data && isset($data['descriptions']) && !isset($data['descriptions']['error'])): ?>
            <h3>Your Skin Descriptions:</h3>
            <ul>
                <?php foreach ($data['descriptions'] as $desc): ?>
                    <li><strong><?php echo htmlspecialchars($desc['SkinCondition']); ?>:</strong> <?php echo htmlspecialchars($desc['Description']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($data && isset($data['descriptions']['error'])): ?>
            <p>Error: <?php echo htmlspecialchars($data['descriptions']['error']); ?></p>
        <?php else: ?>
            <p>No skin descriptions available.</p>
        <?php endif; ?>
    </section>

    <h4 style="margin-left: 190px; font-size: 30px;">Recommendation</h4>
    <section class="products-container-recommendation">
        <?php if ($data && !empty($data['products']) && !isset($data['products'][0]['error'])): ?>
            <?php foreach ($data['products'] as $product): ?>
                <div class="product-card">
                    <h3><?php echo htmlspecialchars($product['ProductName']); ?></h3>
                    <?php if ($product['ProductImage3']): ?>
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($product['ProductImage3']); ?>" alt="<?php echo htmlspecialchars($product['ProductName']); ?>" style="max-width: 200px; height: auto; margin: 10px auto; display: block;">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($product['ShortDesrciption'] ?? 'No details available'); ?></p>
                    <p style="font-size: 18px; color: #082731; font-weight: bold;">Match with Your Skin Profile: <?php echo htmlspecialchars($product['match_percentage']); ?>%</p>
                    <p style="font-size: 16px; color: #444;">Concerns: <?php echo htmlspecialchars($product['ConcernType']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No recommendations found.</p>
        <?php endif; ?>
    </section>

    <a href="../consulting.php" class="btn btn-primary btn-lg" role="button" style="background-color:#75bfe1; border-width: 0px; font-weight: bold; width: 230px;">
        Re-Consulting
    </a>

    <?php include '../../../component/footer/footer.php'; ?>
</body>
</html>