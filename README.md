
# API: Library Management System

The Library Management System API provides functionality for user registration, authentication, book management, and secure access control. This system is designed to ensure the effective management of library resources while maintaining user data confidentiality and secure token-based authentication mechanisms.


## Author Endpoints
---

**AUTHOR: Register Account**

Endpoint: `/author/register`

Method: `POST`

Description:
Allows a new author to register by providing a unique name and password. The password is securely hashed using SHA256 before being stored in the database.

**Payload:**
 ```json
    {
        "username": "janedoe",
        "password": "securepassword123"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "token": "<TOKEN>",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "fail",
                  "data": {
                      "title": "Authentication Failed!"
                  }
              }
          ```
#

**AUTHOR: Login Account**

Endpoint: `/author/login`

Method: `POST`

Description:
Authenticates an author by validating the provided username and password. If valid, a JWT token is generated and stored in an HTTP-only cookie for session management.

**Payload:**
 ```json
    {
        "username": "janedoe",
        "password": "securepassword123"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "token": "<TOKEN>",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "fail",
                  "data": {
                      "title": "Authentication Failed!"
                  }
              }
          ```
#

**AUTHOR: Authenticate Account**

Endpoint: `/author/auth`

Method: `POST`

Description:
Validates an author’s credentials and generates a JWT token for authentication. Deletes any blacklisted tokens during the process to ensure a clean session.

**Payload:**
 ```json
    {
        "username": "janedoe",
        "password": "securepassword123"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "token": "<TOKEN>",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "fail",
                  "data": {
                      "title": "Authentication Failed!"
                  }
              }
          ```

**AUTHOR: Register Account**

Endpoint: `/author/register`

Method: `POST`

Description:
Allows a new author to register by providing a unique name and password. The password is securely hashed using SHA256 before being stored in the database.

**Payload:**
 ```json
    {
        "username": "janedoe",
        "password": "securepassword123"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "token": "<TOKEN>",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "fail",
                  "data": {
                      "title": "Authentication Failed!"
                  }
              }
          ```
