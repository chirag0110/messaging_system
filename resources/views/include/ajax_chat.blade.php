    <div class="flex-3">
        <h2 class="text-xl py-1 mb-8 border-b-2 border-gray-200"><span>Chatting with
                <b>{{ $toUser->name }}</b></span></h2>
    </div>
    <div class="messages flex-1 overflow-auto" id="messages">
        @forelse ($messages as $message)
            <span>
                
                
                @php
                    $chat_time = date('M d, Y h:i A', strtotime(convertUtcDatetoLocal($message->created_at)))
                @endphp
                @if ($user->id == $message->from_user_id)
                    <div class="message me mb-4 flex text-right">
                        <div class="flex-1 px-2">
                            <div class="flex items-center justify-end">
                                <div class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                                    <span>{{ $message->message }}</span>
                                </div>
                                <a href="javascript:void(0)" onclick="deleteMsg({{$message->id}})">
                                    <img class="w-5" src="{{ asset('frontend/images/trash.png') }}"
                                        alt="delete-message" />
                                </a>

                            </div>
                            <div class="pr-4"><small class="text-gray-500">{{ $chat_time }}</small></div>
                        </div>
                    </div>
                    
                @else
                    <div class="message mb-4 flex">
                        <div class="flex-2">
                            <div class="w-12 h-12 relative">
                                <img class="w-12 h-12 rounded-full mx-auto"
                                src="{{ asset('frontend/images/user_avatar.png') }}"
                                    alt="chat-user" />
                            </div>
                        </div>
                        <div class="flex-1 px-2">
                            <div class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                                <span>{{ $message->message }}</span>
                            </div>
                            <div class="pl-4"><small class="text-gray-500">{{ $chat_time }}</small></div>
                        </div>
                    </div>


                   
                @endif


            </span>
        @empty
            <div>There is no message!</div>
        @endforelse

    </div>
