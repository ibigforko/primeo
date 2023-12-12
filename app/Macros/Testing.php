<?php

use Illuminate\Testing\TestResponse;
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
    $this->assertJsonCount($count, Response::PAYLOAD.'.data');
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
            "current_page",
            "data" => [
                "*" => $structure
            ],
            "first_page_url",
            "from",
            "last_page",
            "last_page_url",
            "links" => [
                "*" => [
                    "url",
                    "label",
                    "active"
                ]
            ],
            "next_page_url",
            "path",
            "per_page",
            "prev_page_url",
            "to",
            "total"
        ]
    ]);
});