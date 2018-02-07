# small-php
A PHP micro framework to build APIs

## Router

### Supported https methods
 1) GET
 2) POST
 3) PUT 
 4) DELETE
 
### Parameters
- '/'   Base route
- '{a}' Anything
- '{n}' Only numbers
- '{w}' Only Letters 
- '{b}' Numbers and letters

Example

```
include "server/core/Router.php";

$app = new Router(); 

$app->get('/api/{a}', function($params) {	
   return 'Hello world';	
});

```

## Query Example

```
include "server/core/View.php";
include "server/core/Router.php";
include "server/core/Session.php";
include "server/core/Database.php";

$app = new Router(); 
$app->view = new View();
$app->db = new Database();
$app->session = new Session();

$app->view->setPath("server/templates");

$app->get('/api/products', function($params) {

	$this->db->connect();
	
	$query = '
		SELECT * 
		FROM products';

	$stmt = $this->db->conn->prepare($query);
	$stmt->execute();

	$result = $stmt->fetchAll();

	return $this->json($result);
});
```
