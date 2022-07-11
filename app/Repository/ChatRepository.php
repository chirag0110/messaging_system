<?php

namespace App\Repository;

use App\Models\Chat;
use App\Repository\ChatInterface;
use Illuminate\Support\Facades\Auth;

class ChatRepository implements ChatInterface
{

    public function getMessages($user_id)
    {
        $user = Auth::user();
        $messages = Chat::where(function ($q) use ($user_id, $user) {
            $q->where('from_user_id',$user_id)->where('to_user_id',$user->id);
        })->orWhere(function ($q) use ($user_id, $user) {
            $q->where('from_user_id',$user->id)->where('to_user_id',$user_id);
        })->orderBy('id')->get();

        return $messages;
    }

    public function createOrUpdate($request, $id = null)
    {
        $data = $request->except(['_token', '_method']);
        
        $chat = Chat::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $chat;
    }

    public function deleteMessage($id)
    {
        Chat::find($id)->delete();
    }


}
