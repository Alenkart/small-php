<?php 

include "server/core/View.php";
include "server/core/Router.php";
include "server/core/Session.php";
include "server/core/Database.php";

$app = new Router(); 
$app->view = new View();
$app->db = new Database();
$app->session = new Session();

$app->view->setPath("server/templates");

// ----------------- posts -----------------

$app->get('/api/posts', function($params) {
	return 'Hello World';
});
