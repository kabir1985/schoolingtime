<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<!---------------------For Exam Result Card start----------------------------------------------->
<?php
// Initialize counters
$total_questions = count($questions);
$correct_count = 0;
$wrong_count = 0;
$not_answered_count = 0;
// Loop once to count
foreach ($questions as $q) {
    $status = $q['status'] ?? 'not_answered';
    if ($status == 'correct') {
        $correct_count++;
    } elseif ($status == 'incorrect') {
        $wrong_count++;
    } else {
        $not_answered_count++;
    }

}
// Calculate percentage
$percentage = $total_questions > 0 ? round(($correct_count / $total_questions) * 100, 2) : 0;

// Assuming each question = 1 mark (or you can multiply by marks per question)
$total_marks = $correct_count;
?>
<!--------------------------For Exam Result Card End---------------------------------------->

<div class="container">
    <div class="row">
        <div class="col">  <h2>পরিক্ষার উত্তরপত্র</h2></div>
    </div>

    <div class="row">
        <div class="col-md-7">
                <?php $session = \Config\Services::session();
               echo "নামঃ " . esc($session->get('student_name')) . " (" . esc($session->get('student_id')) . ")"; ?>
        </div>

        <div class="col-md-5 d-flex justify-content-between">
            <p>মোট প্রশ্ন: <?=$total_questions?></p>
            <p>প্রাপ্ত নম্বর: <?=$total_marks?></p>
        </div>
    </div>

    <?php if (!empty($questions)): ?>

    <?php foreach ($questions as $index => $q): ?>

    <div class="question-box">

        <div class="question-title">
            Q<?=$index + 1?>: <?=htmlspecialchars($q['question_title'] ?? 'No Title')?>
        </div>

        <ul style="list-style:none; padding-left:0;">
            <?php
$options = $q['options'] ?? [];
$bangla_letters = ['ক', 'খ', 'গ', 'ঘ', 'ঙ', 'চ', 'ছ', 'জ', 'ঝ', 'ঞ']; // Extend if more options

if (!empty($options)):
    foreach ($options as $opt_index => $opt):
        $is_correct = ($opt['correct_answer'] == "1");
        $is_your = (isset($q['your_answer_id']) && $opt['question_answer_id'] == $q['your_answer_id']);
        $label = $bangla_letters[$opt_index] ?? ''; // assign Bangla letter
        ?>
				            <li class="option
								                                <?=$is_correct ? 'correct-option' : ''?>
								                                <?=(!$is_correct && $is_your) ? 'wrong-option' : ''?>
								                            ">
				                <?php if ($is_correct): ?>
				                <span class="icon">✔</span>
				                <?php elseif ($is_your): ?>
		                <span class="icon">✖</span>
		                <?php else: ?>
                <span class="icon"></span>
                <?php endif; ?>

                <b><?=$label?>.</b> <?=htmlspecialchars($opt['question_option'] ?? '')?>
            </li>
            <?php
endforeach;
else:
?>
            <li class="not-answered">No options available</li>
            <?php endif; ?>
        </ul>

        <!-- Status Message -->
        <?php
$status = $q['status'] ?? 'not_answered';
if ($status == 'correct'): ?>
        <p style="color:green"><b>✔ Correct Answer</b></p>
        <?php elseif ($status == 'incorrect'): ?>
        <p style="color:red"><b>✖ Incorrect</b></p>
        <p><b>Your Answer:</b> <?=htmlspecialchars($q['your_answer_text'] ?? 'N/A')?></p>
        <p><b>Correct Answer:</b> <?=htmlspecialchars($q['correct_answer_text'] ?? 'N/A')?></p>
        <?php else: ?>
        <p class="not-answered" style="color:blue"><b>Not Answered !!!</b></p>
        <p><b>Correct Answer:</b> <?=htmlspecialchars($q['correct_answer_text'] ?? 'N/A')?></p>
        <?php endif; ?>

    </div>

    <?php endforeach; ?>

    <?php else: ?>
    <p style="text-align:center; font-weight:bold;">No questions found for this exam.</p>
    <?php endif; ?>


<!--------------------------------------Result Card Start------------------------------------------------->


    <div class="summary-card" style="text-align:center;">
        <h3>পরিক্ষার সারসংক্ষেপ</h3>
        <p><b>মোট প্রশ্ন:</b> <?=$total_questions?></p>
        <p style="color:green">সঠিক উত্তর: <?=$correct_count?></p>
        <p style="color:red">ভুল উত্তর: <?=$wrong_count?></p>
        <p style="color:blue">উত্তর দেওয়া হয়নি:</b> <?=$not_answered_count?></p>
        <p><b>প্রাপ্ত নম্বর:</b> <?=$total_marks?></p>
        <p><b>শতাংশ:</b> <?=$percentage?>%</p>

        <div class="print-button" style="text-align:right;">
                <button onclick="window.print()">Print Report</button>
            </div>
    </div>



<!----------------------------------Result Card END-------------------------------------------------------->

</div>







<style>
@font-face {
    font-family: 'SolaimanLipi';
    src: url('<?=base_url("public/fonts/SolaimanLipi.ttf")?>') format('truetype');
    font-weight: normal;
    font-style: normal;
}

body {
    background: #f0f2f5;
    /* light background */
    font-family: 'SolaimanLipi', sans-serif;
}

.container {
    max-width: 800px;
    /* limit content width */
    margin: 40px auto;
    /* center horizontally with top margin */
    padding: 0 15px;
}

.question-box {
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    background: #f7faff;
    border-left: 5px solid #0d6efd;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.option {
    padding: 6px 10px;
    margin: 5px 0;
    border-radius: 6px;
}

.correct-option {
    background: #d4f8d4;
    color: green;
    font-weight: bold;
}

.wrong-option {
    background: #ffd6d6;
    color: red;
    font-weight: bold;
}

.not-answered {
    background: #eee;
    color: #555;
}

.question-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.icon {
    font-weight: bold;
    margin-right: 5px;
}

h2 {
    text-align: center;
    /* center the heading */
    margin-bottom: 30px;
}



.summary-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 25px;
   /* max-width: 500px;*/
    margin: 30px auto;
    text-align: center;
    font-family: 'SolaimanLipi', sans-serif;
}

.summary-card h3 {
    margin-bottom: 20px;
    color: #0d6efd;
    font-size: 22px;
    font-weight: bold;
}

.summary-card p {
    margin: 8px 0;
    font-size: 16px;
}

.summary-card b {
    color: #333;
}
</style>