<?php
require_once './Page.php';

class PushToDb extends Page
{
    protected function __construct(){
        parent::__construct();
    }

    protected function __destruct(){
        parent::__destruct();
    }

    public function prozessReceivedData(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = json_decode(file_get_contents("php://input"));
            $warenkorb = $post->warenkorb;
            $address = $post->address;

            //protect SQL Injection
            $firstName = $this->_database->real_escape_string($address->firstName);
            $lastName = $this->_database->real_escape_string($address->lastName);
            $streetName = $this->_database->real_escape_string($address->streetName);
            $streetNumber = $this->_database->real_escape_string($address->streetNumber);
            $postcode = $this->_database->real_escape_string($address->postcode);
            $city = $this->_database->real_escape_string($address->city);


            //add new address record
            $SQLabfrage = "INSERT INTO address SET ".
            "FirstName = \"$firstName\", LastName = \"$lastName\", StreetName = \"$streetName\"
            , StreetNumber = \"$streetNumber\", Postcode = \"$postcode\", City=\"$city\"";
            $this->_database->query ($SQLabfrage);

            //get the inserted addressId
            $addressId = $this->_database->insert_id;

            //add Order
            $addOrderSQLabfrage = "INSERT INTO orders SET ".
                "AddressId = $addressId ";
            $this->_database->query($addOrderSQLabfrage);

            //get the inserted OrderId 
            $orderId = $this->_database->insert_id;
            $_SESSION["OrderId"] = $orderId;

            //add new ordered pizza record
            foreach ($warenkorb as $pizza ){
                // //protect SQL Injection
                $pizzaId = $this->_database->real_escape_string($pizza->id);
                $numberOfOrder = $this->_database->real_escape_string($pizza->numberOfOrder);

                $OrderPizzaSQLabfrage = "INSERT INTO orderedpizza SET"."
                PizzaId = $pizzaId , OrderId = $orderId , NumberOfPizza = $numberOfOrder";
                $this->_database->query ($OrderPizzaSQLabfrage);
            }
            header("Content-type: text/plain; charset=UTF-8");
            echo("OK");
        }
    }

    public static function main()
    {
        try {
            $page = new PushToDb();
            $page->prozessReceivedData();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo ("Fail");
        }
    }
}

PushToDb::main();

