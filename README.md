## Api Documentation 
# POST /api/register 
# Request Body 
{
    "name" : "3adil imam",
    "email" : "a5@gmail.com",
    "password" : "12345",
     "role" : "user" ,
    "wallet" : {
        "balance" : 3000
    }
}
Response 
{
    "user": {
        "name": "3adil imam",
        "email": "a5@gmail.com",
        "role_id": "01958b47-d110-700e-bea5-37bc0dd937d4",
        "updated_at": "2025-03-17T06:25:27.000000Z",
        "created_at": "2025-03-17T06:25:27.000000Z",
        "id": 117
    },
    "role": {
        "id": "01958b47-d110-700e-bea5-37bc0dd937d4",
        "name": "user",
        "decription": "this is user",
        "created_at": "2025-03-12T16:54:54.000000Z",
        "updated_at": "2025-03-12T16:54:54.000000Z"
    }
}
# Get api/wallet 
### Response (200 OK):
{
    "name": "3adil imam",
    "email": "a5@gmail.com",
    "Balance": "3000",
    "serial": 395
}
# Get api/wallet 
[
    {
        "id": "0195a2ca-598c-71f0-bc89-60f166a53b64",
        "amount": "59",
        "sender": 117,
        "receiver": 110,
        "admin": null,
        "created_at": "2025-03-17T06:28:45.000000Z",
        "updated_at": "2025-03-17T06:28:45.000000Z"
    }
]
# Post /api/wallet/transactions
### Request Body 

{
    "name" : "younes kamal",  
    "email" :"a1@gmail.com",
    "amount" : 2000    
}

#### Response (200 OK):
    {
        "id": "0195a2ca-598c-71f0-bc89-60f166a53b64",
        "amount": "59",
        "sender": 117,
        "receiver": 110,
        "admin": null,
        "created_at": "2025-03-17T06:28:45.000000Z",
        "updated_at": "2025-03-17T06:28:45.000000Z"
    }
]
# Post api/admin/rollback 
# Request Body 
{
    "id" : "0195a2ca-598c-71f0-bc89-60f166a53b64"
}
# Response 
{
    "status": "success",
    "message": "Rollback operation completed successfully."
}
