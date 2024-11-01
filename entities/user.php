<?php

    class User {
        private $id;
        private $username;
        private $password;
        private $firstName;
        private $lastName;

        function __construct($username, $password, $firstName, $lastName, $id = null) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
        }

        function getUsername(){
            return $this->username;
        }

        function getPassword(){
            return $this->password;
        }

        function getFirstName(){
            return $this->firstName;
        }

        function getLastName(){
            return $this->lastName;
        }

        function getFullName(){
            return $this->firstName . ' ' . $this->lastName;
        }
    }
?>