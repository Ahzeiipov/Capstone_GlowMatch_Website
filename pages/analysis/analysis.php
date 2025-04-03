<?php include '../../include/database-connection/analysis.php'; ?>
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
    <title>Analyze Ingredients</title>
    <style>
        .analysis-container {
            justify-content: center;
        }
        .analysis-container .analysis {
            margin-top: 100px;
            margin-left: 100px;
            font-size: 20px;
            display: flex;
            gap: 20px;
        }
        .ingredient-scanner {
            margin: 20px auto;
            max-width: 900px;
        }
        .form-group {
            padding: 20px;
        }
        textarea.form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            font-size: 16px;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea::placeholder {
            text-align: center;
            line-height: 450px;
        }
        .btn-primary {
            background-color: #89CFF0;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 35px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            width: 880px;
            margin: 10px auto;
            display: block;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <section>
        <?php include '../../component/navigation/navigation.php'; ?>
    </section>

    <!-- Header -->
    <section class="analysis-container">
        <div class="analysis">
            <h2 style="color:#89CFF0;">Analyze ingredients</h2>
            <h2>| Your analysis</h2>
        </div>
    </section>

    <!-- Ingredient Input -->
    <section>
        <div class="ingredient-scanner">
            <div class="form-group">
                <textarea class="form-control" id="ingredients-textarea" rows="20" placeholder="Paste your ingredients (e.g., Vitamin A, Vitamin C)"></textarea>
            </div>
        </div>
    </section>

    <!-- Analyze Button -->
    <div class="d-grid gap-2">
        <button id="analyze-btn" class="btn btn-primary" type="button">Analyze</button>
    </div>

     <!-- Modal -->
     <div id="modal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
            <?php include '../../component/register_form/sign-in.php'; ?>
        </div>
    </div>
        
    <!-- Footer -->
    <?php include '../../component/footer/footer.php'; ?>

    <!-- JavaScript for Form Submission -->
    <script>
        document.getElementById('analyze-btn').addEventListener('click', function () {
            const userInput = document.getElementById('ingredients-textarea').value.trim();
            if (!userInput) {
                alert('Please enter some ingredients to analyze.');
                return;
            }

            const userIngredientsArray = [...new Set(userInput.split(',').map(i => i.trim().toLowerCase()))];
            
            // Send AJAX request to backend
            fetch('analyze.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ ingredients: userIngredientsArray })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    // Redirect to result page with query parameters
                    const url = `analysis-result/analysis_result.php?matchPercentage=${data.matchPercentage}&description=${encodeURIComponent(data.description)}&matchedIngredients=${encodeURIComponent(JSON.stringify(data.matchedIngredients))}`;
                    window.location.href = url;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error processing your request.');
            });
        });
    </script>
</body>
</html>