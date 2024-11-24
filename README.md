
# API: Library Management System

The Library Management System API provides functionality for user registration, authentication, book management, and secure access control. This system is designed to ensure the effective management of library resources while maintaining user data confidentiality and secure token-based authentication mechanisms.


## Author Endpoints

**AUTHOR: Register Account**

Endpoint: `/author/register`

Method: `POST`

Description:
Allows a new author to register by providing a unique name and password. The password is securely hashed using SHA256 before being stored in the database.

          {
            "username": "janedoe",
            "password": "securepassword123"
          }



    {
        "status": "success",
        "token": "<TOKEN>",
        "data": null
    }



    {
        "status": "fail",
        "data": {
            "title": "Authentication Failed!"
        }
    }
         
