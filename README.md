
# API: Library Management System

The Library Management System API provides functionality for user registration, authentication, book management, and secure access control. This system is designed to ensure the effective management of library resources while maintaining user data confidentiality and secure token-based authentication mechanisms.


## **Author Endpoints**

#### *Register Account*

Endpoint: `/author/register`

Method: `POST`

Description:
Allows a new author to register by providing a unique name and password. The password is securely hashed using SHA256 before being stored in the database.

**Payload:**
 ```json
    {
        "username": "kjworling",
        "password": "qwerty"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "failed",
                  "data": {
                      "title": "Name already exists"
                  }
              }
          ```
#

#### *Login Account*

Endpoint: `/author/login`

Method: `POST`

Description:
Authenticates an author by validating the provided username and password. If valid, a JWT token is generated and stored in an HTTP-only cookie for session management.

**Payload:**
 ```json
    {
        "username": "kjworling",
        "password": "qwerty"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                 "status": "success",
                 "login_token": "secret",
                 "data": "Access granted"
             }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "failed",
                  "message": "Login failed: Invalid username or password"
              }
          ```
#

#### *Authenticate Account*

Endpoint: `/author/auth`

Method: `POST`

Description:
Validates an author’s credentials and generates a JWT token for authentication. Deletes any blacklisted tokens during the process to ensure a clean session.

**Payload:**
 ```json
    {
        "username": "kjworling",
        "password": "qwerty"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                 "status": "success",
                 "token": "secret",
                 "data": null
             }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "failed",
                  "data": {
                      "title": "auth failed"
                  }
              }
          ```

#

#### *Create Book*

Endpoint: `/book/create`

Method: `POST`

Description:
Allows an authenticated author to create a new book and associate it with their account. The token is blacklisted after use.

**Payload:**
 ```json
    {
    "title": "Parry Hotter"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "data": null
              }
          ```    
    -  **Failed**
        ```json  
              {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
              }
          ```

#

#### *Edit Book*

Endpoint: `/book/edit`

Method: `POST`

Description:
Allows an authenticated author to update the title of their book. The token is blacklisted after use.

**Payload:**
 ```json
    {
    "bookid": 123,
    "title": "Henry Potha"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "message": "Book updated successfully"
              }
          ```    
    -  **Failed**
        ```json  
             {
                 "status": "failed",
                 "message": "Unauthorized: No token provided"
             }
          ```

#

#### *Delete Book*

Endpoint: `/book/delete`

Method: `POST`

Description:
Allows an authenticated author to delete one of their books. The token is blacklisted after use.

**Payload:**
 ```json
    {
    "bookid": 123
    }
```

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "message": "Book deleted successfully"
              }
          ```    
    -  **Failed**
        ```json  
             {
                "status": "failed",
                "message": "Unauthorized: No token provided"
            }
          ```

#

#### *View Book*

Endpoint: `/author/books`

Method: `GET`

Description:
Retrieves all books created by the authenticated author. The token is blacklisted after use.


- **Response:**
     - **Success**
        ```json
              {
                "status": "success",
                "data": [
                    {
                        "bookid": 123,
                        "title": "Book Title",
                        "author_name": "Author Name"
                    },
                    {
                        "bookid": 124,
                        "title": "Another Book",
                        "author_name": "Author Name"
                    }
                ]
            }
          ```    
    -  **Failed**
        ```json  
             {
                 "status": "failed",
                 "message": "Unauthorized: No token provided"
             }
          ```
