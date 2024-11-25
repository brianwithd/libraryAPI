
# API: Library Management System

The Library Management System API provides functionality for user registration, authentication, book management, and secure access control. This system is designed to ensure the effective management of library resources while maintaining user data confidentiality and secure token-based authentication mechanisms.


## Table of Contents

1. [Features](#features) 
2. [Technology Used](#technology-used)
3. [Setting up the Database](#setting-up-the-database)
4. [Author Endpoints](#author-endpoints)
   - [Login Account](#login-account)
   - [Authenticate Account](#authenticate-account)
   - [Create Book](#create-book)
   - [Edit Book](#edit-book)
   - [Delete Book](#delete-book)
   - [View Book](#view-book)
5. [Admin Endpoints](#admin-endpoints)
   - [Register Account](#register-account)
   - [Login Account](#login-account)
   - [Authenticate Account](#authenticate-account)
   - [View All Users and Authors](#view-all-users-and-authors)
   - [Delete User or Author](#delete-user-or-author)
6. [User Endpoints](#user-endpoints)
   - [Register Account](#register-account)
   - [Login Account](#login-account)
   - [Authenticate Account](#authenticate-account)
   - [View All Books](#view-all-books)


## Features

- **JWT Authentication:** Provides secure access to the API using JSON Web Tokens.
- **Token Revocation and Blacklisting:** Ensures tokens are valid for a single use and supports blacklisting for enhanced security.
- **CRUD Operations:** Includes functionality for creating, reading, updating, and deleting user and author-book data.
- **Error Handling:** Delivers detailed error messages for improved debugging and better client-side understanding.

## Technology Used

- **PHP:** The primary backend programming language, utilizing the Slim Framework for streamlined and efficient development.
- **Slim Framework:** A lightweight PHP framework designed for building fast and scalable APIs.
- **[Firebase JWT](https://github.com/firebase/php-jwt):** A library for securely handling JSON Web Tokens (JWT) to manage authentication.
- **PSR-7:** A set of standardized interfaces for HTTP messages, ensuring consistent handling of requests and responses.
- **PHP & MySQL:** PHP handles the backend logic, while MySQL is used as the relational database management system for storing user data, including credentials and account status.

## Setting up the Database

To set up the MySQL database for the application, follow these steps:

1. **Install XAMPP (if not already installed):**
   - Download and install [XAMPP](https://www.apachefriends.org/index.html). This software package includes PHP, MySQL, and Apache, providing the environment required to run the backend and database locally.

2. **Start XAMPP Services:**
   - Launch the XAMPP control panel and start the **Apache** service for PHP and the **MySQL** service for the database.

3. **Set Up the Database:**
   - Open **phpMyAdmin** by visiting `http://localhost/phpmyadmin/` in your web browser.
   - In the **phpMyAdmin** interface, click the **Databases** tab at the top.
   - Under **Create database**, enter **library** as the database name and click **Create**.

4. **Import the SQL File:**
   - Navigate to the `db` folder in your project directory to locate the **`library.sql`** file.
   - In **phpMyAdmin**, select the **library** database you created.
   - Click the **Import** tab in the top menu.
   - Use **Choose File** to select the **`library.sql`** file from the `db` folder, then click **Go** to import it.
   - This will generate the required tables and insert sample data into the database.



---
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

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.


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
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

#

#### *Edit Book*

Endpoint: `/book/edit`

Method: `POST`

Description:
Allows an authenticated author to update the title of their book. The token is blacklisted after use.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.


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
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

#

#### *Delete Book*

Endpoint: `/book/delete`

Method: `POST`

Description:
Allows an authenticated author to delete one of their books. The token is blacklisted after use.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.


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
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

#

#### *View Book*

Endpoint: `/author/books`

Method: `GET`

Description:
Retrieves all books created by the authenticated author. The token is blacklisted after use.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.

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
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

---
## **Admin Endpoints**

#### *Register Account*

Endpoint: `/admin/register`

Method: `POST`

Description:
Allows a new admin to register by providing a unique username and password. The password is securely hashed using SHA256 before being stored in the database.

**Payload:**
 ```json
    {
        "username": "admin",
        "password": "admin"
    }
```

- **Response:**
     - **Success**
        ```json
              {
               "status": "success",
               "message": "Admin account created successfully"
              }
          ```    
    -  **Failed**
        ```json  
              {
                "status": "failed",
                "message": "Username already exists"
            }
          ```
#

#### *Login Account*

Endpoint: `/admin/login`

Method: `POST`

Description:
Allows an admin to log in by providing valid credentials (username and password). If the credentials match, a JWT token is generated and returned to the client.

**Payload:**
 ```json
    {
        "username": "admin",
        "password": "admin"
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
                 "message": "Invalid username or password"
             }
          ```
#

#### *Authenticate Account*

Endpoint: `/admin/auth`

Method: `POST`

Description:
Authenticates an admin user by verifying their credentials (username and password). If authentication is successful, a JWT token is generated and returned to the client. A cleanup operation is also performed to remove any blacklisted tokens from the database.

**Payload:**
 ```json
    {
        "username": "admin",
        "password": "admin"
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
                      "title": "Authentication failed"
                  }
              }
          ```

#

#### *View All Users and Authors*

Endpoint: `/admin/viewAllUsersAndAuthors`

Method: `GET`

Description:
Allows an admin to view all registered users and authors in the system. It validates the admin's token and ensures the token is not blacklisted or expired before retrieving data.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.

- **Response:**
     - **Success**
        ```json
              {
                  "status": "success",
                  "data": {
                      "users": [
                          {"userid": 1, "username": "user1"},
                          {"userid": 2, "username": "user2"}
                      ],
                      "authors": [
                          {"authorid": 1, "authorname": "Author1"},
                          {"authorid": 2, "authorname": "Author2"}
                      ]
                  }
              }
          ```    
    -  **Failed**
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

#

#### *Delete User or Author*

Endpoint: `/admin/deleteUserOrAuthor`

Method: `POST`

Description:
Allows an admin to delete a user or author from the system. The admin's token is validated to ensure they are authorized, and the token is blacklisted after use.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.

**Payload:**
 ```json
    {
    "id": 1,
    "user_type": "user"
    }
 ```
```json
    {
    "id": 2,
    "user_type": "author"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                "status": "success",
                "message": "User deleted successfully"
            }
        ```
        ```json
             {
                "status": "success",
                "message": "Author deleted successfully"
            }
          ```    
    -  **Failed**
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

---
## **User Endpoints**

#### *Register Account*

Endpoint: `/user/register`

Method: `POST`

Description:
Registers a new user in the system. Checks for existing usernames before adding a new user. Passwords are hashed before being stored in the database.

**Payload:**
 ```json
    {
  "username": "firstuser",
  "password": "password"
}
```

- **Response:**
     - **Success**
        ```json
              {
                "status": "success",
                "message": "User registered successfully"
              }
          ```    
    -  **Failed**
        ```json  
              {
                "status": "failed",
                "message": "Username already exists"
              }
          ```
#

#### *Login Account*

Endpoint: `/user/login`

Method: `POST`

Description:
Authenticates a user by checking their credentials. On successful login, generates a JWT token valid for 30 minutes and sets it as an HTTP-only cookie.

**Payload:**
 ```json
    {
        "username": "firstuser",
        "password": "password"
    }
```

- **Response:**
     - **Success**
        ```json
              {
                "status": "success",
                "token": "secret"
              }
          ```    
    -  **Failed**
        ```json  
             {
               "status": "failed",
               "message": "Invalid username or password"
             }
          ```
#

#### *Authenticate Account*

Endpoint: `/user/auth`

Method: `POST`

Description:
Authenticates a user using their username and password. On success, issues a JWT token and clears any blacklisted tokens.

**Payload:**
 ```json
    {
        "username": "firstuser",
        "password": "password"
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
                  "title": "Authentication failed"
                }
              }
          ```

#

#### *View All Books*

Endpoint: `/user/viewBooks`

Method: `GET`

Description:
Fetches a list of books and their associated authors from the database. Requires a valid JWT token in the Authorization header or auth_token cookie.

**Request:**

Authorization: Requires a valid JWT in the `Authorization` header or `admin_token` cookie.

- **Response:**
     - **Success**
        ```json
              {
                "status": "success",
                "data": [
                  {
                    "bookid": 1,
                    "title": "Book Title",
                    "author_name": "Author Name"
                  }
                ]
              }
          ```    
    -  **Failed:**
        - **Unauthorized**
          ```json  
                {
                  "status": "failed",
                  "message": "Unauthorized: No token provided"
                }
            ```
          
         - **Expired Token**
           ```json  
                {
                 "status": "failed",
                 "message": "Token has expired"
               }
            ```
           
         - **Blacklisted Token**
           ```json  
                 {
                   "status": "failed",
                   "message": "Token has already been used"
                 }
             ```

---
