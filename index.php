<?php

use Banking\Controllers\AccountController;
use Banking\Controllers\UserController;
use Banking\Controllers\CardController;
use Banking\Controllers\PanelController;
use Slim\App;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$app = new App;
$container['renderer'] = new \Slim\Views\PhpRenderer("templates/");

$app->group("/panel", function() use ($app) {

    $app->get('/card/{card_number}', function (Request $request, Response $response, $args) {
        $card_number = $args["card_number"];
        $card = [
            "card_number"=>$card_number
        ];
        return $this->renderer->render($response, "card.php", ["card"=>$card]);
    });

    $app->group("/dashboard", function() use ($app) {

    });

    $app->group("/transactions", function() use ($app) {

    });

    $app->group("/accounts", function() use ($app) {

    });
});

$app->group("/api", function() use($app) {
    $app->group("/v1", function() use ($app) {
        $app->group("/users", function() use ($app) {
            $app->post("", [new UserController(), "createUser"]);
        });

        $app->group("/cards", function() use ($app) {
            $app->post("", [new CardController(), "createCard"]);
        });

        $app->group("/accounts", function() use ($app) {
            $app->post("", [new AccountController(), "createAccount"]);
        });

        $app->group("/transaction", function() use ($app) {
            
        });

    });
});

$app->run();