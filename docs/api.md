# API Endpoint

## Get List Users

Endpoint: GET /api/users

Query Params
- username: search by username, optional
- page: number of page, optional,
- rows: limit rows per page, optional

Response Body Success:
```
{
    "data": [
        {
            "user_id": "123",
            "username": "john.doe",
            "created_at": "2025-01-21T12:10:28.000000Z",
            "updated_at": "2025-01-21T12:10:28.000000Z"
        },
        {
            "user_id": "456",
            "username": "jane.doe",
            "created_at": "2025-01-21T12:10:28.000000Z",
            "updated_at": "2025-01-21T12:10:28.000000Z"
        }
    ],
    "message": "OK"
}
```

Response Body Error
```
{
    "errors": "Server Error"
}
```

## Get Score Leaderboard

Endpoint: GET /api/users/score/leaderboard

Query Params
- username: search by username, optional
- page: number of page, optional,
- rows: limit rows per page, optional

Response Body Success:
```
{
    "data": [
        {
            "username": "john.doe",
            "highscore": 1000,
            "last_level": 100
        },
        {
            "username": "jane.doe",
            "highscore": 900,
            "last_level": 70
        }
    ],
    "message": "OK"
}
```

Response Body Error
```
{
    "errors": "Server Error"
}
```

## Submit Score

Endpoint: POST /api/users/score/submit

Request Body
```
{
    "user_id": "123",
    "score": 500,
    "level": 100
}
```

Response Body Success:
```
{
    "user_id": "123",
    "score": 500,
    "level": 100
}
```

Response Body Error
```
{
    "errors": "Score must required"
}
```

## Assessment

Endpoint: GET /api/assessment

Response Body Success:
```
{
    "success": true,
    "request_ts": 1737462833902,
    "message": "OK"
}
```

Response Body Error
```
{
    "errors": "Server Error"
}
```