<?php
namespace Banking\Model;

use Banking\Model\BaseModel;

class CardModel extends BaseModel {

    public function getCard($user_id) : array {
        $query = $this->conn->prepare("SELECT * FROM cards WHERE user_id = :uid");
        $query->bindParam(":uid", $user_id);
        $query->execute();

        return $query->fetch();
    }

    public function create(string $first, string $middle, string $last, string $pinNumber, int $user_id) : bool {
        $cardNumber = $this->generateNumber();
        $expDate    = $this->generateEXPDate();
        $cvv        = $this->generateCVV();
        $hashed     = password_hash($pinNumber, PASSWORD_DEFAULT);

        $query = $this->conn->prepare("INSERT INTO cards(first_name, middle_initial, last_name, card_number, exp_date, cvv, pin_number, user_id) VALUES (:fn, :mi, :ln, :cn, :exp, :cvv, :pin, :uid)");
        $query->bindParam(":fn", $first);
        $query->bindParam(":mi", $middle);
        $query->bindParam(":ln", $last);
        $query->bindParam(":cn", $cardNumber);
        $query->bindParam(":exp", $expDate);
        $query->bindParam(":cvv", $cvv);
        $query->bindParam(":pin", $hashed);
        $query->bindParam(":uid", $user_id);

        return $query->execute();
    }

    private function generateEXPDate() : string {
        $date = strtotime(date("d/m/Y"));
        $new_date = strtotime('+ 1 year', $date);

        return date('m/Y', $new_date);
    }

    private function generateNumber() : string {
        $prefix = 336;
        return $prefix . $this->getRand(16 - strlen($prefix));
    }

    private function getRand($length) {
        $rand = '';
        for ($index = 1; $index < $length; $index++) {
            $rand .= rand(0, 9);
        }

        return $rand;
    }

    private function generateCVV() : string {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

}