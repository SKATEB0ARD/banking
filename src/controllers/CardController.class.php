<?php
namespace Banking\Controllers;

use Banking\Model\CardModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CardController {


    public function createCard(Request $request, Response $response, $args = []) {
        $body = $request->getBody();
        $cardModel = new CardModel();

        $card = json_decode($body);
        if(strlen($card->pin_number) > 4) {
            $cardModel->error(401, "the pin is longer than 4 numbers!");
        }
        if(!$cardModel->create($card->first_name, $card->middle_initial, $card->last_name, $card->pin_number, 0)) {
            $cardModel->error(400, "Could not create card at this point.");
        }
        $card = $cardModel->getCard(0);

        $cardModel->respond(200, 
        [
            "first_name"=>$card["first_name"],
            "middle_inital"=>$card["middle_initial"],
            "last_name"=>$card["last_name"],
            "card_number"=>$card["card_number"],
            "exp_date"=>$card["exp_date"],
            "cvv"=>$card["cvv"]
        ]);
    }

     
}