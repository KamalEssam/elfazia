---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->

# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_53ade9b1a25d87913d19885d82a0ac44 -->
## api/update/user

> Example request:

```bash
curl -X PUT "/api/update/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/update/user",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/update/user`


<!-- END_53ade9b1a25d87913d19885d82a0ac44 -->

<!-- START_4e11c916287a290559ac0e7917248b3a -->
## Activate the specified user.

> Example request:

```bash
curl -X GET "/api/activateUser/{activate_code}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/activateUser/{activate_code}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/activateUser/{activate_code}`

`HEAD api/activateUser/{activate_code}`


<!-- END_4e11c916287a290559ac0e7917248b3a -->

<!-- START_e382b0f671e31690697228f25834c788 -->
## Store a newly created StadiumComment in storage.

POST /stadiumComments

> Example request:

```bash
curl -X POST "/api/stadium_comments" \
-H "Accept: application/json" \
    -d "rate"="aut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/stadium_comments",
    "method": "POST",
    "data": {
        "rate": "aut"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/stadium_comments`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    rate | string |  required  | 

<!-- END_e382b0f671e31690697228f25834c788 -->

<!-- START_6e1b3d703163afd8bd8e26868a2501a3 -->
## Store a newly created StadiumFavorite in storage.

POST /stadiumFavorites

> Example request:

```bash
curl -X POST "/api/favorites" \
-H "Accept: application/json" \
    -d "stadium_id"="quos" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/favorites",
    "method": "POST",
    "data": {
        "stadium_id": "quos"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/favorites`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    stadium_id | string |  required  | 

<!-- END_6e1b3d703163afd8bd8e26868a2501a3 -->

<!-- START_f24abe1cf8e4fca3251c67dd0b8d7d13 -->
## api/favorites

> Example request:

```bash
curl -X GET "/api/favorites" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/favorites",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/favorites`

`HEAD api/favorites`


<!-- END_f24abe1cf8e4fca3251c67dd0b8d7d13 -->

<!-- START_9c53bdd0462f8a4a26819fd730871e24 -->
## api/reservations/checkDate/do

> Example request:

```bash
curl -X GET "/api/reservations/checkDate/do" \
-H "Accept: application/json" \
    -d "date"="deleniti" \
    -d "hours"="deleniti" \
    -d "branch_id"="deleniti" \
    -d "payment_method"="deleniti" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/checkDate/do",
    "method": "GET",
    "data": {
        "date": "deleniti",
        "hours": "deleniti",
        "branch_id": "deleniti",
        "payment_method": "deleniti"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/checkDate/do`

`HEAD api/reservations/checkDate/do`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    date | string |  required  | 
    hours | string |  required  | 
    branch_id | string |  required  | 
    payment_method | string |  required  | 

<!-- END_9c53bdd0462f8a4a26819fd730871e24 -->

<!-- START_3f798bfe96ec6e4fffd54cae2e1c8abe -->
## POST

> Example request:

```bash
curl -X GET "/api/reservations/store/normal" \
-H "Accept: application/json" \
    -d "date"="eos" \
    -d "hours"="eos" \
    -d "branch_id"="eos" \
    -d "payment_method"="eos" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/store/normal",
    "method": "GET",
    "data": {
        "date": "eos",
        "hours": "eos",
        "branch_id": "eos",
        "payment_method": "eos"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/store/normal`

`HEAD api/reservations/store/normal`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    date | string |  required  | 
    hours | string |  required  | 
    branch_id | string |  required  | 
    payment_method | string |  required  | 

<!-- END_3f798bfe96ec6e4fffd54cae2e1c8abe -->

<!-- START_d199595035dd41ae0f39f05cbda81cb7 -->
## api/reservations/store/monthly

> Example request:

```bash
curl -X GET "/api/reservations/store/monthly" \
-H "Accept: application/json" \
    -d "date"="amet" \
    -d "hours"="amet" \
    -d "branch_id"="amet" \
    -d "payment_method"="amet" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/store/monthly",
    "method": "GET",
    "data": {
        "date": "amet",
        "hours": "amet",
        "branch_id": "amet",
        "payment_method": "amet"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/store/monthly`

`HEAD api/reservations/store/monthly`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    date | string |  required  | 
    hours | string |  required  | 
    branch_id | string |  required  | 
    payment_method | string |  required  | 

<!-- END_d199595035dd41ae0f39f05cbda81cb7 -->

<!-- START_b7a26c5e4def977986bb0725ea9e6789 -->
## Display the specified Reservation.

GET|HEAD /reservations/{id}

> Example request:

```bash
curl -X GET "/api/reservations/cancel/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/cancel/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/cancel/{id}`

`HEAD api/reservations/cancel/{id}`


<!-- END_b7a26c5e4def977986bb0725ea9e6789 -->

<!-- START_542ba710be2d50602bb01cc163afbe27 -->
## api/reservations/rate/{id}/{rate}

> Example request:

```bash
curl -X GET "/api/reservations/rate/{id}/{rate}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/rate/{id}/{rate}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/reservations/rate/{id}/{rate}`

`HEAD api/reservations/rate/{id}/{rate}`


<!-- END_542ba710be2d50602bb01cc163afbe27 -->

<!-- START_ed050b55f36f627588d7f975a0f1c58e -->
## api/reservations/rate/later

> Example request:

```bash
curl -X GET "/api/reservations/rate/later" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/rate/later",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/rate/later`

`HEAD api/reservations/rate/later`


<!-- END_ed050b55f36f627588d7f975a0f1c58e -->

<!-- START_1287c333ea250faf2927a8a36e879da0 -->
## api/reservations/upcoming

> Example request:

```bash
curl -X GET "/api/reservations/upcoming" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/upcoming",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/upcoming`

`HEAD api/reservations/upcoming`


<!-- END_1287c333ea250faf2927a8a36e879da0 -->

<!-- START_6d5093f658d8860b733ec385cb5004dd -->
## api/reservations/previous

> Example request:

```bash
curl -X GET "/api/reservations/previous" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/reservations/previous",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/reservations/previous`

`HEAD api/reservations/previous`


<!-- END_6d5093f658d8860b733ec385cb5004dd -->

<!-- START_c5980aec5cfeb84d336b262343a9c2af -->
## Display a listing of the League.

GET|HEAD /leagues

> Example request:

```bash
curl -X GET "/api/leagues/all" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/leagues/all",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/leagues/all`

`HEAD api/leagues/all`


<!-- END_c5980aec5cfeb84d336b262343a9c2af -->

<!-- START_e93866087943b9831af3ed07fe38badd -->
## Display a listing of the League.

GET|HEAD /leagues

> Example request:

```bash
curl -X GET "/api/leagues/my" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/leagues/my",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/leagues/my`

`HEAD api/leagues/my`


<!-- END_e93866087943b9831af3ed07fe38badd -->

<!-- START_ff16c8209bd8f2a56be7fa905b1543b7 -->
## Store a newly created LeagueTeam in storage.

> Example request:

```bash
curl -X GET "/api/leagues/join/{league_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/leagues/join/{league_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/leagues/join/{league_id}`

`HEAD api/leagues/join/{league_id}`


<!-- END_ff16c8209bd8f2a56be7fa905b1543b7 -->

<!-- START_849726c94107836f7abe8603bcb868fe -->
## Display the specified League.

GET|HEAD /leagues/{id}

> Example request:

```bash
curl -X GET "/api/leagues/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/leagues/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/leagues/show/{id}`

`HEAD api/leagues/show/{id}`


<!-- END_849726c94107836f7abe8603bcb868fe -->

<!-- START_2c3056e8579bf19ad767849ee4d97e7a -->
## Display a listing of the Gift.

GET|HEAD /gifts

> Example request:

```bash
curl -X GET "/api/gifts" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/gifts",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/gifts`

`HEAD api/gifts`


<!-- END_2c3056e8579bf19ad767849ee4d97e7a -->

<!-- START_8fff4213db5c8947d4b97f6554e32f83 -->
## Display the specified Gift.

GET|HEAD /gifts/{id}

> Example request:

```bash
curl -X POST "/api/gifts/win/{gift_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/gifts/win/{gift_id}",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/gifts/win/{gift_id}`


<!-- END_8fff4213db5c8947d4b97f6554e32f83 -->

<!-- START_6afdc657a85056375497754a13e8b97c -->
## api/apiKey/{device_id}

> Example request:

```bash
curl -X GET "/api/apiKey/{device_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/apiKey/{device_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "accessKey": "eyJpdiI6ImpOT3BKMUhkTU5rREF5WW1OVis4SEE9PSIsInZhbHVlIjoiOGtqM2RnV0FuY3Nndjd1UVVQZzVDZz09IiwibWFjIjoiNmEyYmI4YTU3MjNmNWIzNTEyNzg0NzQzZDQxMGE5N2RjMzFjNGUwYjdkNzBiNmViZTMzZWVjYmEyYWIwYTdkYiJ9",
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/apiKey/{device_id}`

`HEAD api/apiKey/{device_id}`


<!-- END_6afdc657a85056375497754a13e8b97c -->

<!-- START_d1ffe84b72c46df42c72b36b3f471b2e -->
## api/token

> Example request:

```bash
curl -X GET "/api/token" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/token",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "token not provided",
    "success": false,
    "status_code": 401
}
```

### HTTP Request
`GET api/token`

`HEAD api/token`


<!-- END_d1ffe84b72c46df42c72b36b3f471b2e -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login

> Example request:

```bash
curl -X POST "/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## api/register

> Example request:

```bash
curl -X POST "/api/register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/register",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_8ad860d24dc1cc6dac772d99135ad13e -->
## api/password/reset

> Example request:

```bash
curl -X POST "/api/password/reset" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/password/reset",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/password/reset`


<!-- END_8ad860d24dc1cc6dac772d99135ad13e -->

<!-- START_d2f267efcc2ae54270c0f83e3445240e -->
## Display a listing of the Sponsor.

GET|HEAD /sponsors

> Example request:

```bash
curl -X GET "/api/sponsors" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/sponsors",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": {
        "main": [
            {
                "id": 1,
                "image": "http:\/\/localhost\/letsplay\/storage\/app\/public\/uploads\/XqhwJY1fJll77ApCn9B7CtPulnCAMBcJcY3X7sVe.png",
                "link": null,
                "body": "test",
                "title": "test"
            }
        ],
        "part": [
            {
                "id": 2,
                "image": "http:\/\/localhost\/letsplay\/storage\/app\/public\/uploads\/Qq8GSW9ORNfx0kdDOoq3H8jJWlry6K9J7GwaxjgN.png",
                "link": null,
                "body": "test",
                "title": "test"
            }
        ]
    },
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/sponsors`

`HEAD api/sponsors`


<!-- END_d2f267efcc2ae54270c0f83e3445240e -->

<!-- START_4e93193bf49af503facd40b9c63faf90 -->
## api/home

> Example request:

```bash
curl -X GET "/api/home" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/home",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": {
        "basic": [
            {
                "id": 2,
                "lat": 0,
                "lng": 0,
                "image": null,
                "title": null,
                "region": "vzxv",
                "district": "tes",
                "views": 123,
                "area": 13,
                "price": 12,
                "priceDiscount": 0,
                "favorite": false
            },
            {
                "id": 3,
                "lat": 0,
                "lng": 0,
                "image": null,
                "title": "fas",
                "region": "vzxv",
                "district": "tes",
                "views": 135,
                "area": 14,
                "priceDiscount": 10,
                "price": 12,
                "favorite": false
            }
        ],
        "offers": [
            {
                "id": 3,
                "lat": 0,
                "lng": 0,
                "image": null,
                "title": "fas",
                "region": "vzxv",
                "district": "tes",
                "views": 135,
                "area": 14,
                "priceDiscount": 10,
                "price": 12,
                "favorite": false
            }
        ],
        "ads": []
    },
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/home`

`HEAD api/home`


<!-- END_4e93193bf49af503facd40b9c63faf90 -->

<!-- START_c2438bf84ed7aadda6ade0daf52903bd -->
## api/offers

> Example request:

```bash
curl -X GET "/api/offers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/offers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": {
        "offers": [
            {
                "id": 3,
                "area": 14,
                "price": 12,
                "price_discount": 10,
                "features": "1",
                "views": 12,
                "title": "tes",
                "region": "vzxv",
                "district": "tes",
                "lat": 31,
                "lng": 31,
                "rate": 0,
                "images": []
            }
        ],
        "ads": []
    },
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/offers`

`HEAD api/offers`


<!-- END_c2438bf84ed7aadda6ade0daf52903bd -->

<!-- START_479a6b389e2740259356e4f3a52faab1 -->
## api/nearest/{lat}/{lng}

> Example request:

```bash
curl -X GET "/api/nearest/{lat}/{lng}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/nearest/{lat}/{lng}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/nearest/{lat}/{lng}`

`HEAD api/nearest/{lat}/{lng}`


<!-- END_479a6b389e2740259356e4f3a52faab1 -->

<!-- START_109ac5053c673f98c987f5d0e97aa50c -->
## Display the specified Stadium.

GET|HEAD /stadia/{id}

> Example request:

```bash
curl -X GET "/api/stadium/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/stadium/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": {
        "id": 1,
        "lat": 31,
        "lng": 32,
        "image": "1234",
        "title": null,
        "description": "123",
        "region": "vzxv",
        "district": "tes",
        "stadiumNum": 0,
        "rate": 2,
        "views": 0,
        "area": 0,
        "price": null,
        "priceDiscount": 0,
        "favorite": false,
        "branches": [],
        "offers": [],
        "comments": [
            {
                "id": 1,
                "comment": "test",
                "rate": 2,
                "username": "hamada1",
                "userImage": null
            }
        ],
        "ads": []
    },
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/stadium/show/{id}`

`HEAD api/stadium/show/{id}`


<!-- END_109ac5053c673f98c987f5d0e97aa50c -->

<!-- START_b85616631c095a85d0f6bac9a8ef907e -->
## api/stadium/get/comments/{id}

> Example request:

```bash
curl -X GET "/api/stadium/get/comments/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/stadium/get/comments/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": [
        {
            "id": 1,
            "comment": "test",
            "rate": 2,
            "username": "hamada1",
            "userImage": null
        }
    ],
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/stadium/get/comments/{id}`

`HEAD api/stadium/get/comments/{id}`


<!-- END_b85616631c095a85d0f6bac9a8ef907e -->

<!-- START_ce480dace858fcf7855597bb5389d6bc -->
## Store a newly created Stadium in storage.

POST /stadia

> Example request:

```bash
curl -X POST "/api/stadium/request" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/stadium/request",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/stadium/request`


<!-- END_ce480dace858fcf7855597bb5389d6bc -->

<!-- START_8df8f5663f405749c6f23d1980943bd2 -->
## Display the specified StadiumBranch.

GET|HEAD /stadiumBranches/{id}

> Example request:

```bash
curl -X GET "/api/stadium_branches/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/stadium_branches/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "id": 1,
    "area": 13,
    "price": 12,
    "price_discount": 12,
    "features": "123",
    "views": 123,
    "title": "123",
    "region": "vzxv",
    "district": "tes",
    "lat": 31,
    "lng": 31,
    "rate": 0,
    "images": [
        "12",
        "4214"
    ],
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/stadium_branches/show/{id}`

`HEAD api/stadium_branches/show/{id}`


<!-- END_8df8f5663f405749c6f23d1980943bd2 -->

<!-- START_18bd5ab9d84ed920b0e25737c2549032 -->
## Display a listing of the Config.

GET|HEAD /configs

> Example request:

```bash
curl -X GET "/api/configs" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/configs",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "result": {
        "config": {
            "distance_search": 1000,
            "about": "fasf",
            "rules": "asf",
            "contact": "s",
            "complete_message": "safd"
        },
        "regions": [
            {
                "id": 2,
                "title": "vzxv",
                "districts": [
                    {
                        "id": 1,
                        "title": "tes"
                    }
                ]
            }
        ],
        "features": [
            {
                "id": 1,
                "image_on": "",
                "image_off": "",
                "title": "fasf"
            }
        ]
    },
    "success": true,
    "status_code": 200
}
```

### HTTP Request
`GET api/configs`

`HEAD api/configs`


<!-- END_18bd5ab9d84ed920b0e25737c2549032 -->

<!-- START_a08520c8ef5a670f5b54997b956fc329 -->
## Store a newly created Complain in storage.

POST /complains

> Example request:

```bash
curl -X POST "/api/complains" \
-H "Accept: application/json" \
    -d "name"="ipsam" \
    -d "email"="ipsam" \
    -d "subject"="ipsam" \
    -d "description"="ipsam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "/api/complains",
    "method": "POST",
    "data": {
        "name": "ipsam",
        "email": "ipsam",
        "subject": "ipsam",
        "description": "ipsam"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/complains`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | string |  required  | 
    subject | string |  required  | 
    description | string |  required  | 

<!-- END_a08520c8ef5a670f5b54997b956fc329 -->

