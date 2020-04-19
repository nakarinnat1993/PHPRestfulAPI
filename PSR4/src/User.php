<?php

namespace BasicAPI;

class User
{ 
    public $first_name = "";
    public $last_name = "";
    public $email = "";

    public function login(){
        echo $this->first_name;
        echo $this->last_name;
        echo $this->email;
    }


}
