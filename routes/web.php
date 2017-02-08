<?php

Route::get('/', 'PageController@home')->name('home_page');

Route::group(['prefix'=>'/schools'], function (){
    Route::get('/', 'SchoolController@listSchools')->name('school_page');
    Route::get('{school_id}/members', 'SchoolController@listMembers')->name('school_members_page');

    Route::get('/delete/{school_id}', 'SchoolController@deleteSchool')->name('school_delete_page');
    Route::post('/add', 'SchoolController@addSchool')->name('school_add_page');
});

Route::group(['prefix'=>'/members'], function (){
    Route::get('/', 'MemberController@listMembers')->name('member_page');

    Route::get('/delete/{member_id}', 'MemberController@deleteMember')->name('member_delete_page');
    Route::post('/add', 'MemberController@addMember')->name('member_add_page');
});