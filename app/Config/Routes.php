<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$routes->get('/googlelogin', 'AuthController::index');
$routes->get('/auth/callback', 'AuthController::callback');
$routes->get('/', 'HomepageController::index');
$routes->get('/affiliate', 'HomepageController::course_affiliate');
$routes->get('/course-details-page/(:any)?', 'HomepageController::Course_details_view/$1');

$routes->get('loginSupperAdmin', 'SupperAdminController::index');
$routes->post('/login-create','SupperAdminController::create');
$routes->get('/supperadminview', 'SupperAdminController::supperAdminView');
$routes->get('/supperAdminlogout', 'SupperAdminController::logout');

$routes->get('supperadmin/courseStatus', 'CourseActiveInactiveController::index');
$routes->post('/courseStatusUpdate', 'CourseActiveInactiveController::courseStatusUpdate');
$routes->get('supperadmin/coursetypeadd', 'CourseTypeAddController::index');
$routes->get('supperadmin/course-section-add', 'CourseTypeAddController::course_section_add');
$routes->get('supperadmin/coursecategoryadd', 'CourseCategoryController::index');
$routes->get('supperadmin/sales-commission-view', 'CourseCategoryController::sales_commission');
$routes->post('supperadmin/sales-commission-insert', 'CourseCategoryController::sales_commission_insert');
$routes->post('supperadmin/sales-commission-update', 'CourseCategoryController::sales_commission_update');
$routes->post('supperadmin/coursecategoryinsert', 'CourseCategoryController::insert');
$routes->post('supperadmin/coursecategoryupdate', 'CourseCategoryController::update');
$routes->get('supperadmin/showcourse-category', 'CourseCategoryController::coursecategory_show');
$routes->get('supperadmin/showcourse-category-examsetup', 'CourseCategoryController::coursecategory_show_examsetup');
$routes->get('/academic-course', 'CourseCategoryDetailsController::academicCourse');
$routes->get('course-show-academic/(:any)?', 'CourseCategoryDetailsController::CourseShowAcademic/$1');
$routes->get('/skill-development-course', 'CourseCategoryDetailsController::skillDevelopmentCourse');
$routes->get('/job-admission-course', 'CourseCategoryDetailsController::job_admission_course');
$routes->get('course-show-skill-development/(:any)?', 'CourseCategoryDetailsController::CourseShowSkillDevelopment/$1');
$routes->get('/category-wise-course', 'CourseCategoryDetailsController::index');
$routes->get('course-show-categorywise/(:any)?', 'CourseCategoryDetailsController::CourseShowCateryWise/$1');
$routes->get('/copyright', 'HomepageController::copyright');

$routes->group('student', static function ($routes) {
    $routes->get('login', 'StudentloginController::index');
    $routes->get('login/(:any)?', 'StudentloginController::index/$1');
    $routes->get('login-insert', 'StudentloginController::student_login_check_view');
    $routes->get('registration', 'StudentregistrationController::index');
    $routes->post('registration-insert', 'StudentregistrationController::store');
    $routes->get('exam-system', 'StudentDashboardController::exam_system_view');
    $routes->get('dashboard', 'StudentDashboardController::index');
    $routes->post('feedback', 'StudentDashboardController::feedback_submission');
    $routes->get('admission-test', 'StudentloginController::index');
    $routes->get('profile', 'StudentDashboardController::student_profile_create', ['filter' => 'authGuard']);
    $routes->post('profile-update', 'StudentDashboardController::student_profile_update', ['filter' => 'authGuard']);
    $routes->get('course-selection', 'StudentDashboardController::course_selection');
    $routes->get('cart-view', 'StudentDashboardController::cartView');
    $routes->get('manage-cart', 'StudentDashboardController::manageCart');
    $routes->post('checkout', 'CheckoutController::checkoutCart');
    $routes->post('purchase-course', 'CheckoutController::purchase_course');
    $routes->POST('update-cart', 'StudentDashboardController::updateCart');
    $routes->get('student-guide', 'StudentregistrationController::student_guide');
    $routes->get('student-logout', 'StudentloginController::logout', ['filter' => 'authGuard']);
});

$routes->group('teacher', static function ($routes) {
    $routes->get('register', 'TeacherregistrationController::index');
    $routes->post('create', 'TeacherregistrationController::store');
    $routes->get('login-view', 'TeacherloginController::index');
    $routes->get('login', 'TeacherloginController::login_store');
    $routes->get('dashboard', 'TeacherDashboardController::index', ['filter' => 'authGuard']);
    $routes->get('profile', 'TeacherDashboardController::profileview', ['filter' => 'authGuard']);
    $routes->post('profile-update', 'TeacherDashboardController::teacher_profile_update');
    $routes->get('course-view', 'TeacherDashboardController::TeacherCourseCreateView', ['filter' => 'authGuard']);
    $routes->post('course-create', 'TeacherDashboardController::teacher_course_insert_db');
    $routes->get('batch-create', 'TeacherDashboardController::batchCreate');
    $routes->post('batch-store', 'TeacherDashboardController::batchStore');
    $routes->get('batch-update', 'TeacherDashboardController::batchUpdate', ['filter' => 'authGuard']);
    $routes->get('course-include', 'TeacherDashboardController::course_include_view', ['filter' => 'authGuard']);
    $routes->post('course-include-insert', 'TeacherDashboardController::courseInclude_insert_db', ['filter' => 'authGuard']);
    $routes->get('course-content-from-db', 'TeacherDashboardController::TeacherCourseContentFromDb', ['filter' => 'authGuard']);
    $routes->get('course-include-from-db', 'TeacherDashboardController::TeacherCourseIncludeFromDb', ['filter' => 'authGuard']);
    $routes->get('batch-data-from-db', 'TeacherDashboardController::batchDataFromDb', ['filter' => 'authGuard']);
    $routes->get('course-content-view', 'TeacherDashboardController::TeacherCourseContentCreate', ['filter' => 'authGuard']);
    $routes->post('course-content-insert', 'TeacherDashboardController::TeacherCourseContentInsert', ['filter' => 'authGuard']);
    $routes->get('course-content-delete', 'TeacherDashboardController::teacherCourseContentDelete', ['filter' => 'authGuard']);
    $routes->post('course-content-update', 'TeacherDashboardController::TeacherCourseContentUpdate', ['filter' => 'authGuard']);
    $routes->get('course-include-update', 'TeacherDashboardController::TeacherCourseIncludeUpdate', ['filter' => 'authGuard']); 
    $routes->get('teacher-logout', 'TeacherloginController::logout');
    $routes->post('course-enrolled', 'StudentCoursesController::coursewiseEnrolledStudents', ['filter' => 'authGuard']);
    $routes->get('teacher-guide', 'TeacherregistrationController::teacher_guide');
});

$routes->group('exam', ['filter' => 'authGuard'], static function ($routes) {
    $routes->get('exam-setup-view', 'ExamController::index');
    $routes->post('exam-setup-insert', 'ExamController::exam_setup_insert');
    $routes->get('course-info', 'ExamController::examCourseInfo');
    $routes->get('chapter-info', 'ExamController::courseChapterInfo');
    $routes->get('question-bank-view', 'ExamController::question_bank_View');
    $routes->post('question-bank-insert', 'ExamController::question_bank_insert_db');
    $routes->get('question-set', 'QuestionSetController::index');
    $routes->post('question-insert-into-set', 'QuestionSetController::question_set_insert_db');
    $routes->post('question-set-creation', 'QuestionSetController::question_show_for_set_creation');
    $routes->get('question-show', 'QuestionAnswerController::index');
    $routes->get('exam-show', 'QuestionAnswerController::exam_show_subject_wise');
    $routes->get('result-show/(:any)/(:any)', 'QuestionAnswerController::exam_result_show/$1/$2');
    $routes->get('question-show-subject-wise/(:any)?', 'QuestionAnswerController::question_set_subject_wise/$1');
    $routes->get('questionsetshow/(:any)?', 'QuestionAnswerController::question_set_show/$1');
    $routes->get('question-set-exam-start/(:any)?', 'QuestionAnswerController::question_set_exam_start/$1');
    $routes->get('exam-question-show/(:any)/(:any)', 'QuestionAnswerController::question_show_for_selection/$1/$2');
    $routes->get('current-test/(:any)', 'QuestionAnswerController::currentTest/$1');
    $routes->post('question-answer-insert', 'QuestionAnswerController::question_answer_insert');
    $routes->get('exam-result', 'ExamResultController::index');
    $routes->get('report-generate/(:any)/(:any)', 'ExamResultController::generateReport/$1/$2');
});
