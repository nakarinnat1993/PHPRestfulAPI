<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        echo "Hello";
    });
    $app->get('/about', function (Request $request, Response $response, array $args) use ($container) {
        echo "About";
    });
    $app->post('/data', function (Request $request, Response $response, array $args) use ($container) {
        echo "Post page";
    });
    $app->put('/data', function (Request $request, Response $response, array $args) use ($container) {
        echo "Put page";
    });
    $app->delete('/data', function (Request $request, Response $response, array $args) use ($container) {
        echo "Delete page";
    });

    $app->group('/api', function () use ($app) {
        $container = $app->getContainer();
        $app->post('/data', function (Request $request, Response $response, array $args) use ($container) {
            echo "Group Post page";
        });
        $app->put('/data', function (Request $request, Response $response, array $args) use ($container) {
            echo "Group Put page";
        });
        $app->delete('/data', function (Request $request, Response $response, array $args) use ($container) {
            echo "Group Delete page";
        });
        $app->get('/products', function (Request $request, Response $response, array $args) use ($container) {
            $sql = "SELECT * FROM products";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll();
            if (count($products)) {
                $input = [
                    'status' => 'Success',
                    'message' => 'Read product success',
                    'data' => $products
                ];
            } else {
                $input = [
                    'status' => 'Fail',
                    'message' => 'Empty product',
                    'data' => $products
                ];
            }
            return $this->response->withJson($input);
        });
    });
};
