<?php

return [
    "400" => [
        "title" => "Bad Request",
        "description" => "The request the client made is incorrect or corrupt."
    ],
    "401" => [
        "title" => "Unauthorized",
        "description" => "Sorry, but You are not autorithed to access this page..."
    ],
    "403" => [
        "title" => "Forbidden",
        "description" => "Access to this resource on the server is denied."
    ],
    "404" => [
        "title" => "Page Not Found",
        "description" => "Sorry, the page you are looking for could not be found."
    ],
    "405" => [
        "title" => "Method Not Allowed",
        "description" => "Whoops, something went wrong on our servers."
    ],
    "419" => [
        "title" => "The Page Expired",
        "description" => "Sorry, Your session has expired. Please refresh and try again."
    ],
    "422" => [
        "title" => "Unprocessable Entity",
        "description" => "An error occurred while validating the input data. Please check that all required fields are filled in and try again"
    ],
    "500" => [
        "title" => "Internal Server Error",
        "description" => "Whoops, something went wrong on our servers."
    ],
    "502" => [
        "title" => "Bad Gateway",
        "description" => "The server is temporary overloaded and can’t process Your request."
    ],
    "503" => [
        "title" => "Service Unavailable",
        "description" => "The service You requested is not available at this time. Please try again later."
    ],
    "504" => [
        "title" => "Gateway Timeout",
        "description" => "The server didn't respond in time."
    ] 
];