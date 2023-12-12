<?php

use Illuminate\Testing\TestResponse;
use App\Core\Pagination;
use App\Core\Response;


TestResponse::macro('assertJsonMessage', function() {
    $this->assertJsonStructure([
        Response::STATUS_CODE,
        Response::SUCCESS,
        Response::MESSAGE
    ]);
});

TestResponse::macro('assertJsonPayload', function(Array $structure) {
    $this->assertJsonStructure([
        Response::STATUS_CODE,
        Response::SUCCESS,
        Response::PAYLOAD => $structure
    ]);
});

TestResponse::macro('assertJsonDataCount', function(Int $count) {
    $this->assertJsonCount($count, Response::PAYLOAD.'.'.Pagination::DATA);
});

TestResponse::macro('assertJsonWithErrors', function(Array $structure) {
    $this->assertJsonStructure([
        Response::STATUS_CODE,
        Response::SUCCESS,
        Response::ERRORS => $structure
    ]);
});

TestResponse::macro('assertJsonWithPagination', function(Array $structure) {
    $this->assertJsonStructure([
        Response::STATUS_CODE,
        Response::SUCCESS,
        Response::PAYLOAD => [
            Pagination::CURRENT_PAGE,
            Pagination::TOTAL,
            Pagination::DATA => [
                "*" => $structure
            ],
            Pagination::PER_PAGE,
            Pagination::NEXT_PAGE_URL,
            Pagination::PREV_PAGE_URL
        ]
    ]);
});