<?php
function formatDateToBangla($date) {
    if ($date === '0000-00-00' || !$date) {
        return '-'; // Handle invalid date format
    }
    
    // Convert to DateTime object and format as dd-mm-yyyy
    $formattedDate = DateTime::createFromFormat('Y-m-d', $date)->format('d-m-Y');

    // Array mapping English digits to Bengali digits
    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

    // Convert formatted date to Bengali
    $banglaDate = str_replace(range(0, 9), $banglaDigits, $formattedDate);
    
    return $banglaDate;
}

// Define other helper functions if needed
?>

<article class="entry entry-single">
  <h2 class="entry-title">
	  <a href="#"><?= esc($course_title); ?></a>
  </h2>
  <hr>
  <div class="entry-content">
	  <p style="text-align: justify;">
		  <?= esc($course_note); ?>
	  </p>
  </div>

  <?php 
  // Define the convertToBangla function here if not already defined
  function convertToBangla($number) {
      $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
      return str_replace(range(0, 9), $banglaDigits, $number);
  }
  
  foreach ($course_batch as $batch_info) { 
	   // Calculate the remaining seats
	   $remainingSeats = $batch_info->max_seats - $batch_info->booked_seats;
    
    // Only show batch information if remaining seats are greater than 0
    if ($remainingSeats > 0) { ?>
    <div class="entry-footer">
	  <i class="bi bi-watch"></i>
	  <ul class="cats">
		  <li><a href="#">ব্যাচ:</a></li>
		  <li><a href="#"><?= convertToBangla($batch_info->batch_id); ?></a></li>
	  </ul>

	  <i class="bi bi-watch"></i>
	  <ul class="cats">
		  <li><a href="#">শুরু:</a></li>
		  <li><a href="#"><?= formatDateToBangla($batch_info->start_date); ?></a></li>
	  </ul>

	  <i class="bi bi-person-plus-fill"></i>
	  <ul class="cats">
		  <li><a href="#">সিট বাকী:</a></li>
		  <li><a href="#"><?= convertToBangla($remainingSeats); ?></a></li>
	  </ul>
	  
	  <i class="bi bi-tags"></i>
	  <ul class="tags">
		  <li><a href="#">ক্লাস সিডিউল:</a></li>
		  <li><a href="#"><?= esc($batch_info->weekly_days)." (".esc($batch_info->time_slot).")"; ?></a></li>
	  </ul>
	</div>
  <?php } //End if
  } ?>
</article>


<!---------------------------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div class="modal-body">
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
			  </button>
			  <!-- 16:9 aspect ratio -->
			  <div class="ratio ratio-16x9 text-center">
				  <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
				  <h1 id="no_video">No Video Found !</h1>
			  </div>
		  </div>
	  </div>
  </div>
</div>
<!-------------------------------->

<article class="entry entry-single">
  <!-- <h5 class="entry-title">-->
  <h5><a href="#"> কোর্সের মাধ্যমে যা শিখবেন -</a></h5>
  <hr>
  <!-- </h5>-->
  <div class="entry-content">
	  <?php
		$what_you_will_learn = $what_will_learn;
		$str_arr = explode(",", $what_you_will_learn);
		?>
	  <ul>
		  <?php foreach ($str_arr as $item): ?>
			  <li><?= esc(trim($item)); ?></li>
		  <?php endforeach; ?>
	  </ul>
  </div>
</article><!-- End blog entry -->

<article class="entry entry-single">
  <div class="card">
	  <div class="card-body">
		  <h5 class="card-title">
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs">
				  <li class="nav-item">
					  <a class="nav-link active" data-bs-toggle="tab" href="#index">সিলেবাস</a>
				  </li>
				  <li class="nav-item">
					  <a class="nav-link" data-bs-toggle="tab" href="#teacher">শিক্ষক </a>
				  </li>
				  <li class="nav-item">
					  <a class="nav-link" data-bs-toggle="tab" href="#exam">পরীক্ষা</a>
				  </li>
				  <li class="nav-item">
					  <a class="nav-link" data-bs-toggle="tab" href="#question">জিজ্ঞাসা </a>
				  </li>
			  </ul>
			  <!-- Tab panes -->
			  <div class="tab-content">
				  <div class="tab-pane container active" id="index">
				    <!--------------------------সিলেবাস/ সূচীপ্ত্র--------------------->
                    <?php include_once("course_details_syllabus.php"); ?>
					<!--------------------------সিলেবাস/ সূচীপ্ত্র  END--------------------->
				  </div>
				  
				  <!------------------Teacher Information Start------------------------------->
				  <div class="tab-pane container fade mt-3" id="teacher">
                  <?php include_once("course_details_teacher_info.php"); ?>
				  </div>
				  <!------------------Teacher Information END------------------------------->
				 
                  <!---------------------------Exam Start----------------------------------->
				  <div class="tab-pane container fade mt-3" id="exam">
                    <?php include_once("course_details_exam_info.php"); ?>
				  </div>
				  <!---------------------------------Exam End--------------------------------------------------------->

				  <!---------------------------Course Question/ ASK Start-------------------------------------------------------->
				  <div class="tab-pane container fade mt-3" id="question">
                   <?php include_once("course_details_question_ask.php"); ?>
				  </div>
				  <!---------------------------Course Question/ ASK End-------------------------------------------------------->
			  </div>
	  </div>
  </div>

</article>

<!-- End blog author bio -->