<?php

namespace App\Enums;

enum HttpStatus: int
{
    case OK = 200;
    case CREATED = 201;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case SERVER_ERROR = 500;
}
