<?php
//Admin routes
Route::group(['prefix' => 'admin', 'middleware'=> 'admin'], function() {
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::resource('users','UsersController');
	Route::resource('careers','CareersController');
	Route::post('updatecareer', 'CareersController@updatecareer')->name('admin.updatecareer');
	Route::post('updatesubject', 'SubjectsController@updatesubject')->name('admin.updatesubject');
	Route::get('students', 'StudentsController@index')->name('students.index');
	Route::get('teachers', 'TeachersController@teacherslist')->name('admin.teachers');
	Route::get('editstatus/{id}', 'TeachersController@editstatus')->name('admin.teachersstatus');
	Route::resource('subjects','SubjectsController');
	Route::resource('students','StudentsController');
	Route::get('createsubjectlist',['uses'=>'SubjectslistController@create','as'=>'createsubjectlist']);
	Route::post('storesubjectlist',['uses'=>'SubjectslistController@store','as'=>'storesubjectlist']);
});
//students routes
Route::group(['prefix' => 'student', 'middleware' =>'student'], function() {
	Route::post('/logout','Auth\StudentLoginController@logout')->name('student.logout');
	Route::get('/', 'StudentController@index')->name('student.index');
	Route::get('porfile', 'StudentController@porfile')->name('student.porfile');
	Route::post('changepassword', 'StudentController@changepassword')->name('student.changepassword');
	Route::post('updateinfo', 'StudentController@updateinfo')->name('student.updateinfo');
	Route::get('studentratings', 'RatingsController@index_student')->name('ratings.index');
	Route::post('report', 'RatingsController@ratingsreport')->name('ratings.report');
	Route::post('availablesubjects', 'RatingsController@availablesubjects')->name('student.availablesubjects');
  Route::get('indexschedule_student',['uses'=>'StudentsubjectsController@indexschedule_student','as'=>'indexschedule_student']);
  Route::resource('academicload', 'AcademicloadsController', ['only' => ['create','store']]);
	Route::post('showsubjectsacload',['uses'=>'SubjectslistController@showsubjectsacload','as'=>'showsubjectsacload']);
});
// teacher routes
Route::group(['prefix' => 'teacher', 'middleware' =>'teacher'], function() {
	  Route::get('/logout','Auth\TeacherLoginController@logout')->name('teacher.logout');
	  Route::post('modulesofday','AttendancelistController@modulesofday')->name('teacher.modulesofday');
    Route::get('/', 'TeacherController@index')->name('teacher.index');
	  Route::get('indexschedule_teacher',['uses'=>'SubjectslistController@indexschedule_teacher','as'=>'indexschedule_teacher']);
		Route::resource('attendancelist','AttendancelistController');
    Route::post('showassistancelist',['uses'=>'AttendancelistController@showassistancelist','as'=>'showassistancelist']);
    Route::post('storeassistancelist',['uses'=>'AttendancelistController@storeassistancelist','as'=>'storeassistancelist']);
    Route::post('moduleslist',['uses'=>'ModulesController@moduleslist','as'=>'moduleslist']);
  	Route::resource('modules','ModulesController');
		Route::resource('assignaments','AssignmentsController');
	  Route::post('showstandars','StudentsubjectsController@showstandars')->name('standars.showstandars');
		Route::post('assignmentslist',['uses'=>'StudentsubjectsController@assignmentslist','as'=>'assignmentslist']);
		Route::get('history', 'AttendancelistController@history')->name('attendancelist.history');
    Route::post('storescore', 'AssignmentsController@storescore')->name('assignaments.storescore');
    Route::post('store', 'AssignmentsController@store')->name('assignaments.store');
		Route::post('store', 'RatingsController@store')->name('ratings.store');
    Route::get('create', 'RatingsController@create')->name('ratings.create');
	  Route::post('showhistory', 'AttendancelistController@showhistory')->name('attendancelist.showhistory');
	  Route::post('attupdate', 'AttendancelistController@attupdate')->name('attendancelist.attupdate');
		Route::post('studentlist', 'RatingsController@studentlist')->name('ratings.studentlist');
    Route::post('getmodules', 'RatingsController@getmodules')->name('ratings.getmodules');
	  Route::get('porfile', 'TeacherController@porfile')->name('porfile.teacher');
    Route::post('updateinfo', 'TeacherController@updateinfo')->name('teacher.updateinfo');
    Route::post('changepassword', 'TeacherController@changepassword')->name('teacher.changepassword');
});

// personal routes
Route::group(['prefix' => 'personal', 'middleware' =>'personal'], function() {
	Route::get('/', 'PersonalController@index')->name('personal.index');
	// Route::resource('students','StudentsController');
	// students
	Route::get('createstudent',['uses'=>'StudentsController@create','as'=>'createstudent']);
	Route::get('showstudents{id}',['uses'=>'StudentsController@show','as'=>'showstudents']);
	Route::post('storestudents',['uses'=>'StudentsController@store','as'=>'storestudents']);
	// teachers
	Route::get('indexteachers',['uses'=>'TeachersController@index','as'=>'indexteachers']);
	Route::get('createteacher',['uses'=>'TeachersController@create','as'=>'createteacher']);
	Route::post('storeteachers',['uses'=>'TeachersController@store','as'=>'storeteachers']);
	// subjects
	Route::get('indexratings',['uses'=>'RatingsController@index','as'=>'indexratings']);
	Route::post('searchnipsubjects',['uses'=>'RatingsController@searchnip','as'=>'searchnipsubjects']);
});
// Route::get('/', function () {
//         return view('admin.home');
// });
Auth::routes();
// Route::get('login','LoginstudentsController@showLoginForm');
// Route::post('login',['as'=>'student.auth','uses'=>'LoginstudentsController@studentAuth']);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/student/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('/student/login', 'Auth\StudentLoginController@login')->name('student.login.submit');

Route::get('/teacher/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
