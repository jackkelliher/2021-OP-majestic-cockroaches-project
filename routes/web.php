<?php

use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'prevent-back-history'], function () { //This prevents the back button from showing thhe last page
    Route::resource('auth', 'authController');
    Route::resource('student', 'StudentController')->middleware('auth:web,lecturer');
    Route::resource('cohort', 'CohortController')->middleware('auth:web,lecturer');
    Route::resource('evidence', 'EvidenceController')->middleware('auth:web,lecturer');
    Route::resource('notes', 'NotesController')->middleware('auth:web,lecturer');
    Route::resource('lecturer', 'LecturerController')->middleware('auth:web,lecturer');
    Route::resource('enrolment', 'EnrolmentController')->middleware('auth:web,lecturer');
    Route::resource('paper', 'PaperController')->middleware('auth:web,lecturer');
    Route::resource('user', 'UserController')->middleware('auth:web,lecturer');

    Route::get('/', 'UserController@index');
    Route::get('year{year}', 'CohortController@year')->name('year');
    Route::get('enrolled{year}', 'StudentController@year')->name('enrolled');
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('enroll{studentId}{cohortId}', 'EnrolmentController@enrollStudent')->name('enroll');
    Route::post('unenroll{cohortId}', 'EnrolmentController@unenrollStudents')->name('unenroll');
    Route::post('status{cohortId}', 'EnrolmentController@changeStatus')->name('status');
    Route::post('unassign{id}', 'LecturerController@unassign')->name('unassign');
    Route::post('assign{id}', 'LecturerController@assign')->name('assign');
});
//these are used to login and logout
Route::get('login', 'authController@index');
Route::post('login', 'authController@login')->name('login');
Route::get('login', 'authController@logout')->name('logout');

