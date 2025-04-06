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
    <link rel="shortcut icon" href="../../../asset/image/gm.png" type="x-icon">
    <link rel="stylesheet" href="../../../asset/css/drop_down_menu.css">
    <title>Glow Match</title>
</head>
<body>
    <?php include '../../../component/navigation/navigation.php'; ?>

    <?php
    // Start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user_id is set in session, redirect if not
    if (!isset($_SESSION['user_id'])) {
        header("Location: /php/GlowMatch/pages/homepage/homepage.php");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "skincareconsulting";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION['user_id'];

    // Check if recommendation data is posted (new consultation)
    if (isset($_POST['recommendation_data'])) {
        $data = json_decode($_POST['recommendation_data'], true);
    } else {
        // Fetch existing data from the database
        $data = [];

        // Fetch skin condition
        $sql = "SELECT SkinType, AcneSeverity, DarkSpotsSeverity, LargePoresSeverity 
                FROM skincondition WHERE UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data['skin_type'] = $row['SkinType'];
            $data['acne_severity'] = $row['AcneSeverity'];
            $data['dark_spots_severity'] = $row['DarkSpotsSeverity'];
            $data['large_pores_severity'] = $row['LargePoresSeverity'];
        }
        $stmt->close();

        // Fetch skin descriptions
        $sql = "SELECT sd.SkinCondition, sd.Description
                FROM skincondition sc
                JOIN skindescription sd
                WHERE sc.UserID = ?
                AND (
                    sd.SkinCondition = sc.SkinType
                    OR sd.SkinCondition = CONCAT(sc.AcneSeverity, ' Acne')
                    OR sd.SkinCondition = CONCAT(sc.DarkSpotsSeverity, ' Dark Spots')
                    OR sd.SkinCondition = CONCAT(sc.LargePoresSeverity, ' Large Pores')
                )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data['descriptions'] = [];
        while ($row = $result->fetch_assoc()) {
            $data['descriptions'][] = [
                'SkinCondition' => $row['SkinCondition'],
                'Description' => $row['Description']
            ];
        }
        $stmt->close();

        // Fetch all matching products for the skin type (same as original logic)
        $skinType = $data['skin_type'];
        $severityLevels = [
            'Acne' => $data['acne_severity'],
            'Dark Spots' => $data['dark_spots_severity'],
            'Large Pores' => $data['large_pores_severity']
        ];

        $sql = "SELECT ProductID, ProductName, ShortDesrciption, SkinType, ConcernType, ProductImage3
                FROM products 
                WHERE FIND_IN_SET(?, SkinType) > 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $skinType);
        $stmt->execute();
        $result = $stmt->get_result();

        $data['products'] = [];
        $maxPossibleScore = 1; // Skin type match
        foreach ($severityLevels as $severity) {
            if ($severity != 'None') {
                $maxPossibleScore++;
            }
        }

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $matchScore = 0;
                $concernTypes = explode(',', $row['ConcernType']);

                // Skin type match
                if (stripos($row['SkinType'], $skinType) !== false) {
                    $matchScore++;
                }

                // Concern matches
                foreach ($concernTypes as $concern) {
                    if (strpos($concern, 'Acne') !== false && $severityLevels['Acne'] != 'None' && strpos($concern, $severityLevels['Acne']) !== false) {
                        $matchScore++;
                    }
                    if (strpos($concern, 'Dark Spots') !== false && $severityLevels['Dark Spots'] != 'None' && strpos($concern, $severityLevels['Dark Spots']) !== false) {
                        $matchScore++;
                    }
                    if (strpos($concern, 'Large Pores') !== false && $severityLevels['Large Pores'] != 'None' && strpos($concern, $severityLevels['Large Pores']) !== false) {
                        $matchScore++;
                    }
                }

                $matchPercentage = ($maxPossibleScore > 0) ? ($matchScore / $maxPossibleScore) * 100 : 0;
                $row['match_percentage'] = round($matchPercentage, 2);
                if (!empty($row['ProductImage3'])) {
                    $row['ProductImage3'] = base64_encode($row['ProductImage3']);
                }
                $data['products'][] = $row;
            }
        }
        $stmt->close();
    }

    $conn->close();
    ?>
    
    <div class="message-title">
        <div class="message">Your skin type is</div>
        <div class="underline"></div>
    </div>

    <div class="explaination">
        <?php if ($data): ?>
            <p style="text-align: center; font-size: 18px; font-weight: 600; color: #444;">
                <span style="font-size: 28px; font-weight: bold; color: rgb(66, 135, 181);">
                ✧˖˚<?php echo htmlspecialchars($data['skin_type']); ?>₊˚⊹
                </span><br>
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
            <h3 style="color:rgb(76, 134, 173);">Your Skin Descriptions:</h3>
            <ul>
                <?php 
                $displayedConditions = []; // Array to track displayed SkinConditions
                foreach ($data['descriptions'] as $desc): 
                    if (!in_array($desc['SkinCondition'], $displayedConditions)): // Check if SkinCondition is already displayed
                        $displayedConditions[] = $desc['SkinCondition']; // Add to the displayed list
                ?>
                    <li><strong style="color:rgb(51, 106, 143);" accesskey=""><?php echo htmlspecialchars($desc['SkinCondition']); ?>:</strong> <?php echo htmlspecialchars($desc['Description']); ?></li>
                <?php 
                    endif; 
                endforeach; 
                ?>
            </ul>
        <?php elseif ($data && isset($data['descriptions']['error'])): ?>
            <p>Error: <?php echo htmlspecialchars($data['descriptions']['error']); ?></p>
        <?php else: ?>
            <p>No skin descriptions available.</p>
        <?php endif; ?>
    </section>

    <h4 style="margin-left: 190px; font-size: 30px;" class="underline" >Recommendation</h4>
    <section class="products-container-recommendation">
        <?php if ($data && !empty($data['products']) && !isset($data['products'][0]['error'])): ?>
            <?php foreach ($data['products'] as $product): ?>
                <div class="product-card">
                    <a href="http://localhost/php/GlowMatch/pages/homepage/product/product-detail/product_detail.php?id=<?php echo htmlspecialchars($product['ProductID']); ?>" style="text-decoration: none; color: inherit;">
                        <h3><?php echo htmlspecialchars($product['ProductName']); ?></h3>
                    </a>
                    <?php if ($product['ProductImage3']): ?>
                        <a href="http://localhost/php/GlowMatch/pages/homepage/product/product-detail/product_detail.php?id=<?php echo htmlspecialchars($product['ProductID']); ?>">
                            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($product['ProductImage3']); ?>" alt="<?php echo htmlspecialchars($product['ProductName']); ?>" style="max-width: 200px; height: auto; margin: 10px auto; display: block;">
                        </a>
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

    <a href="reconsult.php" class="btn btn-primary btn-lg" role="button" style="background-color:#75bfe1; border-width: 0px; font-weight: bold; width: 230px;">
        Re-Consulting
    </a>

    <?php include '../../../component/footer/footer.php'; ?>
</body>
</html>