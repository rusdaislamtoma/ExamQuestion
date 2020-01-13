<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::group(['middleware'=>['authorization']], function()
{
	include('authorization.php');
	include('user.php');
});

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as' => 'admin.', 'namespace' =>'Admin','middleware'=> ['auth','authorization']], function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	// Category routes
	Route::get('categories',[
		'as' => 'category.index',
		'uses' => 'CategoryController@index',
	]);
	Route::post('category-store',[
		'as' => 'category.store',
		'uses' => 'CategoryController@store',
	]);

	Route::get('category-edit',[
		'as' => 'category.edit',
		'uses' => 'CategoryController@edit',
	]);
	Route::post('categories-update',[
		'as' => 'category.update',
		'uses' => 'CategoryController@update',
	]);
	Route::post('categories-destroy/{id}',[
		'as' => 'category.destroy',
		'uses' => 'CategoryController@destroy',
	]);
// Route End

    // School Routes start
    Route::get('school','SchoolController@index')->name('school.index');
    Route::post('school-store', 'SchoolController@store')->name('school.store');
    Route::get('school-edit', 'SchoolController@edit')->name('school.edit');
    Route::post('school-update','SchoolController@update')->name('school.update');
    Route::post('school-destroy/{id}', 'SchoolController@destroy')->name('school.destroy');
    // School Routes end
    

	// Grade Routes start
	Route::get('grade','GradeController@index')->name('grade.index');
	Route::post('grade-store', 'GradeController@store')->name('grade.store');
	Route::get('grade-edit', 'GradeController@edit')->name('grade.edit');
	Route::post('grade-update','GradeController@update')->name('grade.update');
	Route::post('grade-destroy/{id}', 'GradeController@destroy')->name('grade.destroy');
	// Grade Routes end

	// Subject routes start
	Route::get('{slug}/subjects','SubjectController@index')->name('grade.subject');
	Route::get('{slug}/subjects/create','SubjectController@create')->name('grade.subject.create');
	Route::post('{slug}/subjects/store','SubjectController@store')->name('grade.subject.store');
	Route::get('{slug}/subjects/{subject}/edit','SubjectController@edit')->name('grade.subject.edit');
	Route::put('{slug}/subjects/{subject}/update','SubjectController@update')->name('grade.subject.update');
	Route::get('{slug}/subjects/{subject}/destroy','SubjectController@destroy')->name('grade.subject.destroy');
	// Subject routes end

	// Subject part start
	Route::get('{subject}/part','SubjectPartController@index')->name('subject.part.index');
	Route::get('{subject}/part/create','SubjectPartController@create')->name('subject.part.create');
	Route::post('{subject}/part/store','SubjectPartController@store')->name('subject.part.store');
	Route::get('{subject}/part/{subjectPart}/edit','SubjectPartController@edit')->name('subject.part.edit');
	Route::put('{subject}/part/{subjectPart}/update','SubjectPartController@update')->name('subject.part.update');
	Route::get('{subject}/part/{subjectPart}/destroy','SubjectPartController@destroy')->name('subject.part.destroy');
	// Subject part end

	// Subject section start
	Route::get('{subject}/section','SubjectSectionController@index')->name('subject.section.index');
	Route::get('{subject}/section/create','SubjectSectionController@create')->name('subject.section.create');
	Route::post('{subject}/section/store','SubjectSectionController@store')->name('subject.section.store');
	Route::get('{subject}/section/{subjectSection}/{id}/edit','SubjectSectionController@edit')->name('subject.section.edit');
	Route::put('{subject}/section/{subjectSection}/{id}/update','SubjectSectionController@update')->name('subject.section.update');
	Route::get('{subject}/section/{subjectSection}/destroy','SubjectSectionController@destroy')->name('subject.section.destroy');
	// Subject section end

	// Subject Question start
	Route::get('{subject}/question','SubjectQuestionController@index')->name('subject.question.index');
	Route::get('{subject}/question/create','SubjectQuestionController@create')->name('subject.question.create');
	Route::post('{subject}/question/store','SubjectQuestionController@store')->name('subject.question.store');
	Route::get('{subject}/question/{id}/edit','SubjectQuestionController@edit')->name('subject.question.edit');
	Route::put('{subject}/question/{id}/update','SubjectQuestionController@update')->name('subject.question.update');
	Route::get('{subject}/question/{id}/destroy','SubjectQuestionController@destroy')->name('subject.question.destroy');
	// Subject Question end

    //Make Question start
    Route::get('{subject}/make_question','MakeQuestionController@index')->name('make.question.index');
    Route::get('{subject}/make_question/create','MakeQuestionController@create')->name('make.question.create');
    Route::post('{subject}/make_question/store','MakeQuestionController@store')->name('make.question.store');
    Route::get('{subject}/make_question/{code_id}/{section_id}/again_generate','MakeQuestionController@edit')->name('make.question.again');
    Route::put('{subject}/make_question/{code_id}/update','MakeQuestionController@update')->name('make.question.update');
    Route::get('{subject}/make_question/{code_id}/destroy','MakeQuestionController@destroy')->name('make.question.destroy');
    //print
    Route::get('{subject}/print','MakeQuestionController@print')->name('print.question');
    //Make Question end

    //Ajax Route
    Route::get('ajaxChapterLoadBySectionId/{SectionId}','SettingController@ajaxChapterLoadBySectionId')->name('loadChapter');
    Route::get('ajaxDifficultyLoadByChapterID/{SectionId}/{chapter_id}','SettingController@ajaxDifficultyLoadByChapterID')->name('loadDifficulty');
//    Route::get('ajaxQuestionLoad/{sectionId}/{chapterId}/{difficulty}','SettingController@ajaxQuestionLoad')->name('loadQuestion');
//    Route::get('ajaxMarkLoad/{questionId}','SettingController@ajaxMarkLoad')->name('loadMark');
//    Route::get('add-question-to-queue','SettingController@add_to_queue')->name('question.queue');



    // Subject Written Question start
    Route::get('{subject}/written_question','WrittenQuestionController@index')->name('subject.written_question.index');
    Route::get('{subject}/written_question/create','WrittenQuestionController@create')->name('subject.written_question.create');
    Route::post('{subject}/written_question/store','WrittenQuestionController@store')->name('subject.written_question.store');
    Route::get('{subject}/written_question/{id}/edit','WrittenQuestionController@edit')->name('subject.written_question.edit');
    Route::put('{subject}/written_question/{id}/update','WrittenQuestionController@update')->name('subject.written_question.update');
    Route::get('{subject}/written_question/{id}/destroy','WrittenQuestionController@destroy')->name('subject.written_question.destroy');
    // Subject Written Question end

    //Make Written Question start
    Route::get('{subject}/make_written_question','MakeWrittenQuestionController@index')->name('make.written_question.index');
    Route::get('{subject}/make_written_question/create','MakeWrittenQuestionController@create')->name('make.written_question.create');
    Route::post('{subject}/make_written_question/store','MakeWrittenQuestionController@store')->name('make.written_question.store');
    Route::get('{subject}/make_written_question/{code_id}/{section_id}/again_generate','MakeWrittenQuestionController@edit')->name('make.written_question.again');
    Route::put('{subject}/make_written_question/{code_id}/update','MakeWrittenQuestionController@update')->name('make.written_question.update');
    Route::get('{subject}/make_written_question/{code_id}/destroy','MakeWrittenQuestionController@destroy')->name('make.written_question.destroy');
    //print
    Route::get('{subject}/print/make_written_question','MakeWrittenQuestionController@print')->name('print.make_written_question');
    //Make Written Question end

    //Ajax Route
    Route::get('ajaxChapterLoadBySectionIdforwritten/{SectionId}','SettingController@ajaxChapterLoadBySectionIdforwritten')->name('loadChapterForWritten');
    Route::get('ajaxDifficultyLoadByChapterIDforwritten/{SectionId}/{chapter_id}','SettingController@ajaxDifficultyLoadByChapterIDforwritten')->name('loadDifficultyForWritten');


});
