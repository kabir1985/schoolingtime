<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Report</title>
    <style>
        @font-face {
            font-family: 'SolaimanLipi';
            src: url('<?= base_url("public/fonts/SolaimanLipi.ttf") ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'SolaimanLipi', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .question-container {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .correct-answer {
            background-color: #d4edda;
            padding: 5px;
            border-radius: 3px;
        }

        .incorrect-answer {
            background-color: #FF5733;
            padding: 5px;
            border-radius: 3px;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .option input {
            margin: 0;
        }

        .summary {
            font-weight: bold;
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
        }

        .print-button {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>পরিক্ষার প্রশ্ন এবং উত্তরপত্র</h2>
        <h3>
            <?php $session = \Config\Services::session();
            echo esc($session->get('student_name')) . " (" . esc($session->get('student_id')) . ")";
            ?>
        </h3>

        <?php
        $correctCount = 0;
        $incorrectCount = 0;
        $notAnsweredCount = 0;
        $totalQuestions = count($questions);
        $questionNumber = 1;
        ?>

        <?php if (!empty($questions)): ?>
            <?php foreach ($questions as $question): ?>
                <div class="question-container">
                    <div class="question-title">
                        <?= "Question " . $questionNumber . ": " . esc($question['question_title']) ?>
                    </div>

                    <?php
                    $options = json_decode($question['options'], true);
                    $yourAnswer = "Not Answered";
                    $correctAnswer = "Not Available";
                    $answered = false;
                    ?>

                    <?php if (is_array($options)): ?>
                        <?php foreach ($options as $option): ?>
                            <?php
                            $isCorrect = ($option['correct_answer'] == 1);
                            $userSelected = ($option['your_answer_option'] == $option['question_option']);

                            if ($userSelected) {
                                $yourAnswer = $option['question_option'];
                                $answered = true;
                            }

                            if ($isCorrect) {
                                $correctAnswer = $option['question_option'];
                            }

                            $class = '';
                            if ($isCorrect && $userSelected) {
                                $class = 'correct-answer';
                                $correctCount++;
                            } elseif (!$isCorrect && $userSelected) {
                                $class = 'incorrect-answer';
                                $incorrectCount++;
                            }
                            ?>
                            <div class="option <?= $class ?>">
                                <input type="radio" disabled <?= $userSelected ? 'checked' : '' ?>>
                                <label><?= esc($option['question_option']) ?></label>
                            </div>
                        <?php endforeach; ?>

                        <?php if (!$answered): ?>
                            <?php $notAnsweredCount++; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>No options available.</p>
                        <?php $notAnsweredCount++; ?>
                    <?php endif; ?>

                    <p class="answer-label">Your Answer: <?= esc($yourAnswer) ?></p>
                    <p class="answer-label">Correct Answer: <?= esc($correctAnswer) ?></p>
                </div>
                <?php $questionNumber++; ?>
            <?php endforeach; ?>

            <?php
            $answeredQuestions = $correctCount + $incorrectCount;
            $percentage = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
            ?>

            <div class="summary">
                <h2>Result Summary</h2>
                <span>Total Questions: <?= $totalQuestions ?></span><br>
                <span>Correct Answers: <?= $correctCount ?></span><br>
                <span>Incorrect Answers: <?= $incorrectCount ?></span><br>
                <span>Not Answered: <?= $notAnsweredCount ?></span><br>
                <span>Percentage: <?= $percentage ?>%</span>
            </div>

            <div class="print-button">
                <button onclick="window.print()">Print Report</button>
            </div>

        <?php else: ?>
            <p>No questions found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
