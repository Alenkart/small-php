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
include "server/core/Database.php";

$app = new Router(); 
$app->db = new Database();

$app->get('/api', function($params) {	
   return 'Test Api';	
});

// Getting parameters
$app->get('/api/products/{n}/{w}', function($params) {
   
   return $this->json([
   	'numbers' => $params[1],
	'letters' => $params[2],
   ]);
   
});

```

## Query Example

```
include "server/core/View.php";
include "server/core/Router.php";
include "server/core/Database.php";

$app = new Router(); 
$app->view = new View();
$app->db = new Database();

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
