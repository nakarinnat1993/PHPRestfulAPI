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
        $app->get('/products/{id}', function (Request $request, Response $response, array $args) use ($container) {
            $sql = "SELECT * FROM products WHERE id='$args[id]'";
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
        $app->post('/products', function (Request $request, Response $response, array $args) use ($container) {
            $body = $this->request->getParsedBody();
            // print_r($body);
            $img = "noimg.jpg";
            $sql = "INSERT INTO products(product_name,product_detail,product_barcode,product_price,product_qty,product_image) 
                        VALUES(:product_name,:product_detail,:product_barcode,:product_price,:product_qty,:product_image)";
            $sth = $this->db->prepare($sql);
            $sth->bindParam("product_name", $body['product_name']);
            $sth->bindParam("product_detail", $body['product_detail']);
            $sth->bindParam("product_barcode", $body['product_barcode']);
            $sth->bindParam("product_price", $body['product_price']);
            $sth->bindParam("product_qty", $body['product_qty']);
            $sth->bindParam("product_image", $img);

            if ($sth->execute()) {
                $data = $this->db->lastInsertId();
                $input = [
                    'id' => $data,
                    'status' => 'success'
                ];
            } else {
                $input = [
                    'id' => '',
                    'status' => 'fail'
                ];
            }

            return $this->response->withJson($input);
        });
        $app->put('/products/{id}', function (Request $request, Response $response, array $args) use ($container) {
            // รับจาก Client
            $body = $this->request->getParsedBody();

            $sql = "UPDATE  products SET 
                               product_name=:product_name,
                               product_detail=:product_detail,
                               product_barcode=:product_barcode,
                               product_price=:product_price,
                               product_qty=:product_qty
                           WHERE id='$args[id]'";

            $sth = $this->db->prepare($sql);
            $sth->bindParam("product_name", $body['product_name']);
            $sth->bindParam("product_detail", $body['product_detail']);
            $sth->bindParam("product_barcode", $body['product_barcode']);
            $sth->bindParam("product_price", $body['product_price']);
            $sth->bindParam("product_qty", $body['product_qty']);


            if ($sth->execute()) {
                $data = $args['id'];
                $input = [
                    'id' => $data,
                    'status' => 'success'
                ];
            } else {
                $input = [
                    'id' => '',
                    'status' => 'fail'
                ];
            }

            return $this->response->withJson($input);
        });
        $app->delete('/products/{id}', function (Request $request, Response $response, array $args) use ($container) {
            // รับจาก Client
            $sql = "DELETE FROM products WHERE id='$args[id]'";

            $sth = $this->db->prepare($sql);

            if ($sth->execute()) {
                $data = $args['id'];
                $input = [
                    'id' => $data,
                    'status' => 'success'
                ];
            } else {
                $input = [
                    'id' => '',
                    'status' => 'fail'
                ];
            }

            return $this->response->withJson($input);
        });
    });
};
