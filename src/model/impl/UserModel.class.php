<?php
namespace Banking\Model;

use Banking\Model\BaseModel;

class UserModel extends BaseModel {

    public function create(string $email, string $password, string $first, string $middle, string $last, string $dob, string $phone, string $address, int $account) : bool {
        $hashed     = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->conn->prepare("INSERT INTO users(email, password, first_name, middle_name, last_name, dob, phone_number, address, account_number) VALUES (:mail, :pword, :first, :mid, :last, :dob, :pn, :add, :an)");
        $query->bindParam(":mail", $email);
        $query->bindParam(":pword", $hashed);
        $query->bindParam(":first", $first);
        $query->bindParam(":mid", $middle);
        $query->bindParam(":last", $last);
        $query->bindParam(":dob", $dob);
        $query->bindParam(":pn", $phone);
        $query->bindParam(":add", $address);
        $query->bindParam(":an", $account);

        return $query->execute();
    }

    public function getUser(int $id) : array {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();


        return $query->fetch();
    }

    

}