<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../src/vendor/autoload.php';

$app = new \Slim\App;

    // $app->post('/user/register', function (Request $request, Response $response, array $args){
    //     error_reporting(E_ALL);
    //     $data = json_decode($request->getBody());
    //     $uname = $data -> username;
    //     $pass = $data -> password;
    //     $servername = "localhost";
    //     $username = "root";
    //     $password = "";
    //     $dbname = "library";

    //     try {
    //         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //         // set the PDO error mode to exception
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $sql = "INSERT INTO users (username, password)
    //         VALUES ('".$uname."', '".hash('SHA256',$pass)."')";
    //         // use exec() because no results are returned
    //         $conn->exec($sql);
    //         $response->getBody()->write(json_encode(array("status"=>"sakses", "data"=>null)));
    //     } catch(PDOException $e) {
    //         $response->getBody()->write(json_encode(array("status"=>"feeled", "data"=>array("title"=>$e->getMessage()))));


    //     }

    //     $conn = null;
    //     return $response;
    // });
    
    // //authentication
    // $app->post('/user/auth', function (Request $request, Response $response, array $args){
    //     error_reporting(E_ALL);
    //     $data = json_decode($request->getBody());
    //     $uname = $data -> username;
    //     $pass = $data -> password;
    //     $servername = "localhost";
    //     $username = "root";
    //     $password = "";
    //     $dbname = "library";
    //     $expire = time();

    //     try {
    //         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //         // set the PDO error mode to exception
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $sql = "SELECT * FROM users where username='".$uname."'
    //                 AND password='".hash('SHA256',$pass)."'";
    //         // use exec() because no results are returned
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute();
    //         $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //         $data=$stmt->fetchAll();

    //         if(count($data)==1){
    //             $key = 'aaa';
    //             $payload = [
    //             'iss' => 'http://example.org',
    //             'aud' => 'http://example.com',
    //             'iat' => $expire,
    //             'exp' => $expire + 60,
    //             'data' => array(
    //                 "username" => $data[0]['username']
    //             )
    //         ];            
    //         $jwt = JWT::encode($payload, $key, 'HS256');
    //         // $response->getBody()->write(json_encode(array("status"=>"success",
    //         // "data"=>array("token"=>"$jwt"))));
    //         $response->getBody()->write(json_encode(array("status"=>"success","token"=>$jwt,"data"=>null)));
    //         }else{
    //             $response->getBody()->write(json_encode(array("status"=>"feeled", "data"=>array("title"=>"auth failed"))));
    //         }
    //     } catch(PDOException $e) {
    //         $response->getBody()->write(json_encode(array("status"=>"feel", "data"=>array("title"=>$e->getMessage()))));
    //     }

    //     $conn = null;
    //     return $response;
    // });


    // $app->post('/login', function (Request $request, Response $response, array $args){
    //     $data=json_decode($request->getBody());
    //     $username=$data->username;
    //     $password=$data->password;
    //     $expire = time(); //returns unix timestamp

    //     if($username == "admin" && $password == "opengate"){
    //         $key = 'aaa';
    //         $payload = [
    //             'iss' => 'http://example.org',
    //             'aud' => 'http://example.com',
    //             'iat' => $expire,
    //             'exp' => $expire + 60,
    //             'data' => array(
    //                 "name" => "jobert d. maniga",
    //                 "access_level" => 1
    //             )
    //         ];            
    //         $jwt = JWT::encode($payload, $key, 'HS256');
    //         $response->getBody()->write(json_encode(array("status"=>"success",
    //         "data"=>array("token"=>"$jwt"))));
    //     }else{
    //         $response->getBody()->write(json_encode(array("status"=>"failed",
    //         "data"=>array("title"=>"login failed"))));
    //     }
    //     return $response;
    // });

    // $app->post('/viewEmployee', function (Request $request, Response $response, array $args){
    //     $key = 'aaa';
    //     $data = json_decode($request->getBody());
    //     $jwt = $data->token;

    //     try {
    //         $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    //         $response->getBody()->write(json_encode(array("status"=>"sakses",
    //         "data"=>array("lname"=>"maniga","fname"=>"jobert"))));
    //         return $response;
    //     }catch(Exception $e){
            
    //     }
        
    // });

    

    // Protected route that verifies the token and reissues a new one with use_limit = 0
    // $app->post('/author/protected', function (Request $request, Response $response, array $args) {
    //     $token = $_COOKIE['auth_token'] ?? '';
    //     $key = 'library_system';

    //     try {
    //         $decoded = JWT::decode($token, new Key($key, 'HS256'));

    //         // Check if the token has already been used
    //         if ($decoded->use_limit <= 0) {
    //             // Token already used, return an error
    //             $response->getBody()->write(json_encode(array("status" => "failed", "data" => "Token has already been used")));
    //             return $response->withStatus(401);
    //         }

    //         // Create a new token with use_limit set to 0 (expired after first use)
    //         $newPayload = [
    //             'iss' => 'http://example.org',
    //             'aud' => 'http://example.com',
    //             'iat' => time(),
    //             'exp' => time() + (3600 * 24),  // Token expires in 24 hours
    //             'use_limit' => 0,  // No longer usable after reissue
    //             'data' => array(
    //                 "authorid" => $decoded->data->authorid,
    //                 "name" => $decoded->data->name,
    //             )
    //         ];

    //         $newJwt = JWT::encode($newPayload, $key, 'HS256');

    //         // Set the new token in HttpOnly cookie
    //         setcookie('auth_token', $newJwt, time() + (3600 * 24), '/', '', false, true);

    //         // Response after successful token validation
    //         $response->getBody()->write(json_encode(array("status" => "success", "new_token" => $newJwt, "data" => "Access granted")));
    //     } catch (Exception $e) {
    //         // Token validation failed
    //         $response->getBody()->write(json_encode(array("status" => "failed", "data" => $e->getMessage())));
    //     }

    //     return $response;
    // });

    

    // $authenticate = function ($request, $response, $next) {
    //     if (!isset($_COOKIE['auth_token'])) {
    //         return $response->withStatus(401)->write('Unauthorized');
    //     }
    
    //     try {
    //         $jwt = $_COOKIE['auth_token'];
    //         $key = 'library_system';  // Same secret key used during JWT encoding
    //         $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    //         $request = $request->withAttribute('author', $decoded->data);  // Attach author data to the request
    //     } catch (Exception $e) {
    //         return $response->withStatus(401)->write('Unauthorized');
    //     }
    
    //     return $next($request, $response);
    // };
    
    

    //author register
    $app->post('/author/register', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $username = $data->username;
        $pass = $data->password;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $checkSql = "SELECT COUNT(*) FROM authors WHERE name = :name";
            $stmt = $conn->prepare($checkSql);
            $stmt->execute([':name' => $username]);
            $exists = $stmt->fetchColumn();
    
            if ($exists) {
                $response->getBody()->write(json_encode(array("status" => "failed", "data" => array("title" => "Name already exists"))));
            } else {
                $sql = "INSERT INTO authors (name, password) VALUES (:name, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':username' => $username,
                    ':password' => hash('SHA256', $pass)
                ]);
                $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
            }
        } catch(PDOException $e) {
            $response->getBody()->write(json_encode(array("status" => "failed", "data" => array("title" => $e->getMessage()))));
        }
    
        $conn = null;
        return $response;
    });

    //author login
    $app->post('/author/login', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $username = $data->username;
        $pass = $data->password;
        $expire = time();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepared statement for author login
            $sql = "SELECT * FROM authors WHERE name = :name AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $pass)  
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $authorData = $stmt->fetchAll();
    
            if (count($authorData) == 1) {
                $key = 'library_system';  
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30), 
                    'use_limit' => 1,  
                    'data' => array(
                        "authorid" => $authorData[0]['authorid'],
                        "username" => $authorData[0]['username'],
                    )               
                ];
    
                
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                
                setcookie('auth_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                
                $response->getBody()->write(json_encode(array("status" => "success", "login_token" => "secret", "data" => "Access granted")));
            } else {
                
                $response->getBody()->write(json_encode([
                    "status" => "failed",
                    "message" => "Login failed: Invalid username or password"
                ]));
            }
        } catch (PDOException $e) {
            
            $response->getBody()->write(json_encode([
                "status" => "failed",
                "message" => $e->getMessage()
            ]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });

    //authenticate author
    $app->post('/author/auth', function (Request $request, Response $response, array $args) {
        error_reporting(E_ALL);
        $data = json_decode($request->getBody());
        $username = $data->username;
        $pass = $data->password;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
        $expire = time();
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT * FROM authors WHERE name = :name AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $pass)
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();
    
            if (count($data) == 1) {
                $key = 'library_system'; 
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30),  
                    'use_limit' => 1, 
                    'data' => array(
                        "authorid" => $data[0]['authorid'],
                        "username" => $data[0]['username'],
                    )
                ];
    
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                
                setcookie('auth_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                $deleteBlacklistSql = "DELETE FROM token_blacklist";
                $deleteStmt = $conn->prepare($deleteBlacklistSql);
                $deleteStmt->execute();
    
                $response->getBody()->write(json_encode(array("status" => "success", "token" => "secret", "data" => null)));
            } else {
                // Authentication failed
                $response->getBody()->write(json_encode(array("status" => "failed", "data" => array("title" => "auth failed"))));
            }
        } catch (PDOException $e) {
            // Error handling
            $response->getBody()->write(json_encode(array("status" => "failed", "data" => array("title" => $e->getMessage()))));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    

    //CRUD of books by authors
    $app->post('/book/create', function (Request $request, Response $response, array $args) {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system'; 
    
        $data = json_decode($request->getBody());
        $title = $data->title;
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $authorid = $decoded->data->authorid;
    
            $sql = "INSERT INTO books (title) VALUES (:title)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->execute();
    
            $bookid = $conn->lastInsertId();
    
            $sql = "INSERT INTO books_authors (bookid, authorid) VALUES (:bookid, :authorid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bookid', $bookid);
            $stmt->bindParam(':authorid', $authorid);
            $stmt->execute();
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $response->getBody()->write(json_encode(["status" => "success", "data" => null]));
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->post('/book/edit', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $bookId = $data->bookid;
        $newTitle = $data->title;
    
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system'; 
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $authorid = $decoded->data->authorid;
    
            $checkBookSql = "SELECT * FROM books_authors WHERE bookid = :bookid AND authorid = :authorid";
            $checkBookStmt = $conn->prepare($checkBookSql);
            $checkBookStmt->execute(['bookid' => $bookId, 'authorid' => $authorid]);
            $book = $checkBookStmt->fetch();
    
            if (!$book) {
                return $response->withStatus(403)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized to edit this book"
                ]));
            }
    
            $updateSql = "UPDATE books SET title = :title WHERE bookid = :bookid";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':title', $newTitle);
            $updateStmt->bindParam(':bookid', $bookId);
            $updateStmt->execute();
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $response->getBody()->write(json_encode(["status" => "success", "message" => "Book updated successfully"]));
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->post('/book/delete', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $bookId = $data->bookid;
    
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system';
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $authorid = $decoded->data->authorid;
    
            $checkBookSql = "SELECT * FROM books_authors WHERE bookid = :bookid AND authorid = :authorid";
            $checkBookStmt = $conn->prepare($checkBookSql);
            $checkBookStmt->execute(['bookid' => $bookId, 'authorid' => $authorid]);
            $book = $checkBookStmt->fetch();
    
            if (!$book) {
                return $response->withStatus(403)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized to delete this book"
                ]));
            }
    
            $deleteSql = "DELETE FROM books WHERE bookid = :bookid";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bindParam(':bookid', $bookId);
            $deleteStmt->execute();
    
            $deleteAssocSql = "DELETE FROM books_authors WHERE bookid = :bookid";
            $deleteAssocStmt = $conn->prepare($deleteAssocSql);
            $deleteAssocStmt->bindParam(':bookid', $bookId);
            $deleteAssocStmt->execute();
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $response->getBody()->write(json_encode(["status" => "success", "message" => "Book deleted successfully"]));
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null; 
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->get('/author/books', function (Request $request, Response $response, array $args) {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system';  
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $authorid = $decoded->data->authorid;
    
            // Blacklist the token after use
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $sql = "SELECT b.bookid, b.title, a.username AS author_name 
                    FROM books b 
                    JOIN books_authors ba ON b.bookid = ba.bookid 
                    JOIN authors a ON ba.authorid = a.authorid
                    WHERE a.authorid = :authorid"; 
    
            $stmt = $conn->prepare($sql);
            $stmt->execute(['authorid' => $authorid]);  
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $books = $stmt->fetchAll();
    
            $response->getBody()->write(json_encode(["status" => "success", "data" => $books]));
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });
    

    //admin - can manage all the users 
    $app->post('/admin/register', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "library";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkUserSql = "SELECT * FROM admins WHERE username = :username";
            $checkStmt = $conn->prepare($checkUserSql);
            $checkStmt->execute(['username' => $username]);
            $existingAdmin = $checkStmt->fetch();
    
            if ($existingAdmin) {
                return $response->withStatus(400)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Username already exists"
                ]));
            }
    
            $hashedPassword = hash('SHA256', $password);
            $sql = "INSERT INTO admins (username, password, role) VALUES (:username, :password, 'admin')";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'username' => $username,
                'password' => $hashedPassword
            ]);
    
            $response->getBody()->write(json_encode(["status" => "success", "message" => "Admin account created successfully"]));
    
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/admin/login', function (Request $request, Response $response, array $args) {
        error_reporting(E_ALL);
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "library";
        $expire = time();
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM admins WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $password)  
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $adminData = $stmt->fetchAll();
    
            if (count($adminData) == 1) {
                $key = 'library_system';  
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30),  
                    'use_limit' => 1,  
                    'data' => [
                        "adminid" => $adminData[0]['adminid'],
                        "username" => $adminData[0]['username'],
                        "role" => $adminData[0]['role']
                    ]
                ];
    
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                setcookie('admin_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                $response->getBody()->write(json_encode([
                    "status" => "success",
                    "token" => "secret",
                    "data" => null
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "status" => "failed",
                    "message" => "Invalid username or password"
                ]));
            }
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode([
                "status" => "failed",
                "message" => $e->getMessage()
            ]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->post('/admin/auth', function (Request $request, Response $response, array $args) {
        error_reporting(E_ALL);
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "library";
        $expire = time();
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM admins WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $password)  
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $adminData = $stmt->fetchAll();
    
            if (count($adminData) == 1) {
                $key = 'library_system'; 
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30),  
                    'use_limit' => 1, 
                    'data' => [
                        "adminid" => $adminData[0]['adminid'],
                        "username" => $adminData[0]['username'],
                        "role" => $adminData[0]['role'] 
                    ]
                ];
    
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                setcookie('admin_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                $deleteBlacklistSql = "DELETE FROM token_blacklist";
                $deleteStmt = $conn->prepare($deleteBlacklistSql);
                $deleteStmt->execute();
    
                $response->getBody()->write(json_encode([
                    "status" => "success",
                    "token" => "secret", 
                    "data" => null
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "status" => "failed",
                    "data" => ["title" => "Authentication failed"]
                ]));
            }
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode([
                "status" => "failed",
                "data" => ["title" => $e->getMessage()]
            ]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->get('/admin/viewAllUsersAndAuthors', function (Request $request, Response $response, array $args) {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['admin_token']) ? $cookies['admin_token'] : '';
        }
    
        $key = 'library_system';  
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $role = $decoded->data->role;
    
            if ($role !== 'admin') {
                return $response->withStatus(403)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Forbidden: You are not authorized to view this resource"
                ]));
            }
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $sqlUsers = "SELECT userid, username FROM users";
            $stmtUsers = $conn->query($sqlUsers);
            $stmtUsers->setFetchMode(PDO::FETCH_ASSOC);
            $users = $stmtUsers->fetchAll();
    
            $sqlAuthors = "SELECT authorid, name AS authorname FROM authors";
            $stmtAuthors = $conn->query($sqlAuthors);
            $stmtAuthors->setFetchMode(PDO::FETCH_ASSOC);
            $authors = $stmtAuthors->fetchAll();
    
            $responseData = [
                "users" => $users,
                "authors" => $authors
            ];
    
            $response->getBody()->write(json_encode(["status" => "success", "data" => $responseData]));
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->post('/admin/deleteUserOrAuthor', function (Request $request, Response $response, array $args) {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system';  
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed",
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed",
                    "message" => "Token has expired"
                ]));
            }
    
            
    
            $data = json_decode($request->getBody());
            $id = $data->id;
            $user_type = $data->user_type;  
    
            if ($user_type === 'user') {
                $sql = "DELETE FROM users WHERE userid = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);
    
                if ($stmt->rowCount() > 0) {
                    $response->getBody()->write(json_encode(["status" => "success", "message" => "User deleted successfully"]));
                } else {
                    $response->getBody()->write(json_encode(["status" => "failed", "message" => "User not found"]));
                }
            } elseif ($user_type === 'author') {
                $sql = "DELETE FROM authors WHERE authorid = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['id' => $id]);
    
                if ($stmt->rowCount() > 0) {
                    $response->getBody()->write(json_encode(["status" => "success", "message" => "Author deleted successfully"]));
                } else {
                    $response->getBody()->write(json_encode(["status" => "failed", "message" => "Author not found"]));
                }
            } else {
                $response->getBody()->write(json_encode(["status" => "failed", "message" => "Invalid user_type provided"]));
            }
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
        } catch (Exception $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    

    //users - view
    $app->post('/user/register', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "library";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkUserSql = "SELECT * FROM users WHERE username = :username";
            $stmt = $conn->prepare($checkUserSql);
            $stmt->execute(['username' => $username]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
            if ($stmt->rowCount() > 0) {
                return $response->getBody()->write(json_encode(["status" => "failed", "message" => "Username already exists"]));
            }
    
            $insertUserSql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $conn->prepare($insertUserSql);
            $stmt->execute([
                'username' => $username,
                'password' => hash('SHA256', $password)
            ]);
    
            $response->getBody()->write(json_encode(["status" => "success", "message" => "User registered successfully"]));
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/user/login', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
        $expire = time();
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "library";
        $key = 'library_system';  
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $password)
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetch();
    
            if ($user) {
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30),  
                    'data' => array(
                        "userid" => $user['userid'],
                        "username" => $user['username'],
                    )
                ];
    
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                setcookie('auth_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                $response->getBody()->write(json_encode(["status" => "success", "token" => "secret"]));
            } else {
                $response->getBody()->write(json_encode(["status" => "failed", "message" => "Invalid username or password"]));
            }
    
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode(["status" => "failed", "message" => $e->getMessage()]));
        }
    
        $conn = null;
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->post('/user/auth', function (Request $request, Response $response, array $args) {
        error_reporting(E_ALL);
        $data = json_decode($request->getBody());
        $username = $data->username;
        $password = $data->password;
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "library";
        $expire = time();
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => hash('SHA256', $password)  
            ]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $userData = $stmt->fetchAll();
    
            if (count($userData) == 1) {
                $key = 'library_system';  
                $payload = [
                    'iss' => 'http://example.org',
                    'aud' => 'http://example.com',
                    'iat' => $expire,
                    'exp' => $expire + (60 * 30),  
                    'data' => [
                        "userid" => $userData[0]['userid'],
                        "username" => $userData[0]['username'],
                    ]
                ];
    
                $jwt = JWT::encode($payload, $key, 'HS256');
    
                setcookie('auth_token', $jwt, $expire + (60 * 30), '/', '', false, true);
    
                $deleteBlacklistSql = "DELETE FROM token_blacklist";
                $deleteStmt = $conn->prepare($deleteBlacklistSql);
                $deleteStmt->execute();
    
                $response->getBody()->write(json_encode([
                    "status" => "success",
                    "token" => "secret",  
                    "data" => null
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "status" => "failed",
                    "data" => ["title" => "Authentication failed"]
                ]));
            }
        } catch (PDOException $e) {
            $response->getBody()->write(json_encode([
                "status" => "failed",
                "data" => ["title" => $e->getMessage()]
            ]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    $app->get('/user/viewBooks', function (Request $request, Response $response, array $args) {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
    
        if (!$token) {
            $cookies = $request->getCookieParams();
            $token = isset($cookies['auth_token']) ? $cookies['auth_token'] : '';
        }
    
        $key = 'library_system';  
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
    
        try {
            if (!$token) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Unauthorized: No token provided"
                ]));
            }
    
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $checkBlacklistSql = "SELECT * FROM token_blacklist WHERE token = :token";
            $blacklistStmt = $conn->prepare($checkBlacklistSql);
            $blacklistStmt->execute(['token' => $token]);
            $blacklistedToken = $blacklistStmt->fetch();
    
            if ($blacklistedToken) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has already been used"
                ]));
            }
    
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
    
            if ($decoded->exp < time()) {
                return $response->withStatus(401)->getBody()->write(json_encode([
                    "status" => "failed", 
                    "message" => "Token has expired"
                ]));
            }
    
            $blacklistTokenSql = "INSERT INTO token_blacklist (token, used_at) VALUES (:token, NOW())";
            $insertBlacklistStmt = $conn->prepare($blacklistTokenSql);
            $insertBlacklistStmt->execute(['token' => $token]);
    
            $sql = "
                SELECT b.bookid, b.title, a.name AS author_name 
                FROM books b
                JOIN books_authors ba ON b.bookid = ba.bookid
                JOIN authors a ON ba.authorid = a.authorid
            ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $books = $stmt->fetchAll();
    
            if (count($books) > 0) {
                $response->getBody()->write(json_encode([
                    "status" => "success",
                    "data" => $books
                ]));
            } else {
                $response->getBody()->write(json_encode([
                    "status" => "success",
                    "data" => [],
                    "message" => "No books found."
                ]));
            }
    
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $response->withStatus(401)->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => "Token has expired"
            ]));
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "status" => "failed", 
                "message" => $e->getMessage()
            ]));
        }
    
        $conn = null;  
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    
    
    
    

    
    
    
    






$app->run();

?>