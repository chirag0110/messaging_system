<?php

namespace App\Repository;

interface ChatInterface 
{
    public function getMessages($user_id);

    public function deleteMessage($id);

    public function createOrUpdate($request, $id = null);

}
