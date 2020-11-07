<?php

namespace Banking\Controllers;

use Banking\Model\UserModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController {

    public function createUser(Request $request, Response $response, $args = []) {
        $body = $request->getBody();
        $userModel = new UserModel();

        $account = json_decode($body);
        if(!$userModel->create($account->email, $account->password, $account->first_name, $account->middle_name, $account->last_name, 
                               $account->dob, $account->phone_number, $account->address, 0)) {
            $userModel->error(400, "Could not create account right now!");
        }
        $user = $userModel->getUser(0);

        $userModel->respond(200, 
        [
            "email"=>$user["email"],
            "first_name"=>$user["first_name"],
            "middle_name"=>$user["middle_name"],
            "last_name"=>$user["last_name"],
            "dob"=>$user["dob"],
            "phone_number"=>$user["phone_number"],
            "address"=>$user["address"],
            "account_number"=>$user["account_number"]
        ]);

    }

}