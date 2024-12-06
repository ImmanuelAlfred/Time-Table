<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Faculty
    Route::apiResource('faculties', 'FacultyApiController');

    // Time Table
    Route::post('time-tables/media', 'TimeTableApiController@storeMedia')->name('time-tables.storeMedia');
    Route::apiResource('time-tables', 'TimeTableApiController');
});
