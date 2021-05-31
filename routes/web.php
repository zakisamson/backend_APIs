<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get("/billing", "BillingController@main");
$router->post("/billing", "BillingController@add_items");
$router->get("/user", "UserController@main");
$router->get("/user/{id}", "UserController@filter");
$router->post("/user", "UserController@create_user");
$router->post("/data", "DataController@main");
$router->post("/auth", "AuthController@main");
$router->post("/addproduct", "AuthController@main");
$router->post("/list", "IndexController@main");

