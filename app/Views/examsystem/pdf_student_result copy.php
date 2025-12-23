<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .question-container { margin-bottom: 20px; }
        .question-title { font-weight: bold; margin-bottom: 10px; }
        .option { margin-bottom: 5px; }
        .correct-answer { background-color: #d4edda; padding: 5px; border-radius: 5px; }
        .incorrect-answer { background-color: #f8d7da; padding: 5px; border-radius: 5px; }
        .option input[type="radio"] { margin-right: 10px; }
        .summary { font-weight: bold; margin-top: 20px; }
        .summary span { display: inline-block; margin-right: 15px; }
        .answer-label { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Questions Report</h1>

    <?php 
    $correctCount = 0;
    $incorrectCount = 0;
    $totalScore = 0;
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

                if (is_array($options)) {
                    foreach ($options as $option) {
                        $isCorrect = ($option['correct_answer'] == 1);
                        $userSelected = ($option['your_answer_option'] == $option['question_option']);

                        // Track the correct answer and the user's selected answer
                        if ($userSelected) {
                            $yourAnswer = $option['question_option'];
                        }
                        if ($isCorrect) {
                            $correctAnswer = $option['question_option'];
                        }

                        $class = '';
                        if ($isCorrect) {
                            $class = 'correct-answer';
                        } elseif ($userSelected) {
                            $class = 'incorrect-answer';
                        }

                        // Count correct and incorrect answers
                        if ($isCorrect && $userSelected) {
                            $correctCount++;
                        } elseif (!$isCorrect && $userSelected) {
                            $incorrectCount++;
                        }
                        ?>
                        <div class="option <?= $class ?>">
                            <input type="radio" disabled <?= $userSelected ? 'checked' : '' ?>>
                            <?= esc($option['question_option']) ?>
                        </div>
                    <?php }
                } else {
                    echo '<p>No options available.</p>';
                }
                ?>
                <p class="answer-label">Your Answer: <?= esc($yourAnswer) ?></p>
                <p class="answer-label">Correct Answer: <?= esc($correctAnswer) ?></p>
            </div>
            <?php $questionNumber++; ?>
        <?php endforeach; ?>

        <?php 
        $totalScore = $correctCount; // Assuming 1 point per correct answer
        $percentage = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
        ?>

        <!-- Display summary of correct, incorrect answers, total score, and percentage -->
        <div class="summary">
            <span>Correct Answers: <?= $correctCount ?></span>
            <span>Incorrect Answers: <?= $incorrectCount ?></span>
            <span>Total Score: <?= $totalScore ?></span>
            <span>Percentage: <?= $percentage ?>%</span>
        </div>
        
    <?php else: ?>
        <p>No questions found.</p>
    <?php endif; ?>

</body>
</html>
