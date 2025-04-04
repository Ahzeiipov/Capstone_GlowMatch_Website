<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../asset/css/consulting.css">
    <link rel="stylesheet" href="../../asset/css/navigation.css">
    <link rel="stylesheet" href="../../asset/css/drop_down_menu.css">
    <title>Consultation</title>
</head>
<body>
    <section>
        <?php include '../../component/navigation/navigation.php'; ?>
    </section>

    <div class="consulting-container">
        <div class="box" id="question-container">
            <h1 id="question-text">Question</h1>
            <div class="ans-options" id="options-container"></div>
            <div class="Thebutton">
                <button class="Previous-btn" onclick="prevQuestion()"><i class="fa-solid fa-chevron-left" style="margin-right: 15px;"></i> Previous</button>
                <button class="next" onclick="nextQuestion()">Next <i class="fa-solid fa-chevron-right" style="margin-left: 55px;"></i></button>
            </div>
        </div>
    </div>

    <section>
        <?php include '../../component/footer/footer.php' ?>
    </section>

    <script>
        fetch('consulting3.php')
            .then(response => response.json())
            .then(questions => {
                window.questions = questions;
                loadQuestion();
            });

        let currentQuestionIndex = 0;
        let selectedOptions = [];

        function loadQuestion() {
            const questionIds = Object.keys(window.questions);
            if (currentQuestionIndex >= questionIds.length) {
                showRecommendation();
                return;
            }

            let questionId = questionIds[currentQuestionIndex];
            let question = window.questions[questionId];

            document.getElementById('question-text').innerText = question.text;
            let optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';

            question.answers.forEach(answer => {
                let button = document.createElement('button');
                button.classList.add('option-btn');
                button.innerText = answer.text;
                button.onclick = () => selectAnswer(questionId, answer.option_id);
                optionsContainer.appendChild(button);
            });
        }

        function selectAnswer(questionId, optionId) {
            selectedOptions.push({ questionId, optionId });
            fetch('consulting3.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `question_id=${questionId}&option_id=${optionId}`
            }).then(() => nextQuestion());
        }

        function nextQuestion() {
            currentQuestionIndex++;
            loadQuestion();
        }

        function prevQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                selectedOptions.pop();
                loadQuestion();
            }
        }

        function showRecommendation() {
            fetch('consulting3.php?recommend=true')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch recommendation data');
                    }
                    return response.json();
                })
                .then(data => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '../../pages/consultation/consulting-result/consulting-result.php'; 
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'recommendation_data';
                    input.value = JSON.stringify(data);
                    form.appendChild(input);

                    document.body.appendChild(form);
                    form.submit();
                })
                .catch(error => {
                    console.error('Error fetching recommendation:', error);
                    alert('An error occurred while fetching recommendations. Please try again.');
                });
        }
    </script>

    <?php
    if (isset($_POST['recommendation_data'])) {
        $data = json_decode($_POST['recommendation_data'], true);
    } else {
        $data = null;
    }
    ?>
</body>
</html>