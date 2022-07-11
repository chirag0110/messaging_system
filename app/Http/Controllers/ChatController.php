<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Repository\ChatInterface;
use App\Repository\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ChatController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $chat;
    public $user;

    public function __construct(ChatInterface $chat, UserInterface $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->user->getOtherUsers($request);
        return view('chat', compact('users'));
        //
    }


    /**
     * Send message to the specific user
     *
     * @param Request $request
     * @return void
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        try {
            $validator = Validator::make($request->all(), [
                'to_user_id' => 'required|exists:users,id',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                $response = [
                    "status" => false,
                    "message" => $validator->errors()->first(),
                    "data" => [],
                ];
            } else {
                
                $request->request->add(['from_user_id' => $user->id]);
                $message = $this->chat->createOrUpdate($request);

                $response = [
                    "status" => true,
                    "message" => 'Message added successfully',
                    "data" => $message,
                ];
            }
        } catch (\Exception $e) {
            report($e);

            $response = [
                "status" => false,
                "message" => 'Error : ' . $e->getMessage(),
                "data" => [],
            ];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified message from storage.
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function deleteMessage(Request $request, $chat_id)
    {
        try{
            $this->chat->deleteMessage($chat_id);
            $response = [
                "status" => true,
                "message" => 'Message deleted successfully',
                "data" => [],
            ];
        } catch (\Exception $e) {
            report($e);

            $response = [
                "status" => false,
                "message" => 'Error : ' . $e->getMessage(),
                "data" => [],
            ];
        }

        return response()->json($response);
    }

    /**
     * Get messages of the specific user
     *
     * @param Request $request
     * @param int $user_id
     * @return void
     */
    public function getMessages(Request $request, $user_id)
    {
        $user = Auth::user();
        $toUser = $this->user->getUserById($user_id);
        $messages = $this->chat->getMessages($user_id);
        return view('include.ajax_chat', compact('messages', 'user', 'toUser'));
    }
}
