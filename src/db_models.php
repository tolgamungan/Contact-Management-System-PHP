<?php

class Contact extends User {
    public $birthday;
    public $phoneNumber;
    public $streetAddress;
    public $city;
    public $province;
    public $postalCode;
    public function __construct() {}
}
class User {
    public $id;
    public $firstName;
    public $lastName;
    public $emailAddress;
}
