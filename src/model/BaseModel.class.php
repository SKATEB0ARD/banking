<?php
namespace Banking\Model;

use Banking\Database\Database;

class BaseModel {
    public $conn;

    public function __construct()
    {
        $db = new Database("localhost", "banking", "root", "");
        $this->conn = $db->getConnection();
    }

    function uuid() : string {
        $data = openssl_random_pseudo_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


    function respond($code, $body) {
        http_response_code($code);
        header('Content-Type: application/json');
        die (json_encode($body));
    }

    function error($code, $message) {
        $this->respond($code, ["status" => "error", "message"=> $message]);
    }

}