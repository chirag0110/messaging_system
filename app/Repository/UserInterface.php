<?php

namespace App\Repository;

interface UserInterface 
{

    public function getOtherUsers($requst);

    public function getUserById($id);
}
