<?php include '../../include/database-connection/analysis.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../navigation/navigation-bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../asset/css/analysis.css">
    <link rel="stylesheet" href="../../asset/css/navigation.css">
    <script src="analysis.js"></script>
    <title>Analyze</title>
</head>

<body>
    <section>
        <?php include '../../component/navigation/navigation.php'; ?>
    </section>
            <div class="analysis">
                <h2 style="color:#89CFF0;">Analyze ingredients</h2>
                <h2>&vert;&nbsp; Your analysis</h2>
            </div>
    </section>
    <section>
        <div class="ingredient-scanner">
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="20"
                    placeholder="Paste your ingredient"></textarea>
            </div>
        </div>
    </section>
    <div class="d-grid gap-2">
        <a href="../analysis/analysis-result/analysis_result.php"><button class="btn btn-primary" type="button"
            style="background-color: #89CFF0; font-weight: bold; font-size: 18px; width:880px;">Button</button></a>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
            <?php include '../../component/register_form/sign-in.php'; ?>
        </div>
    </div>
    <?php include '../../component/footer/footer.php' ?>
</body>

</html>