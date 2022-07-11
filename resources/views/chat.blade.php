<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12" id="app">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="main flex-1 flex flex-col">
                        <div class="flex-1 flex h-full">
                            <div class="sidebar border-solid border-r-2 border-gray-400 mr-6 max-w-6xl">
                                <input type="hidden" name="to_user_id" id="to_user_id" value="">
                                <div class="flex-1 h-full overflow-auto px-2">
                                    @forelse ($users as $user)
                                    <a href="javascript:void(0)" onclick="getMessages({{ $user->id }})">
                                        <div
                                            class="user-list entry cursor-pointer transform bg-white mb-4 rounded p-4 flex shadow-md items-center">
                                            <div class="flex-2">
                                                <div class="w-12 h-12 relative">
                                                    <img class="w-12 h-12 rounded-full mx-auto"
                                                        src="{{ asset('frontend/images/user_avatar.png') }}"
                                                        alt="chat-user" />
                                                </div>
                                            </div>
                                            <div class="flex-1 px-2">
                                                <div class="w-48">
                                                    <span class="text-gray-800">{{ $user->name }}</span>
                                                    <span class="text-indigo-700">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </a>
                                        
                                    @empty
                                        <div>There are no registered users!</div>
                                    @endforelse 
                                </div>
                            </div>
                            <div class="chat-area flex-1 flex flex-col">
                                <div class="chat-area flex-1 flex flex-col hidden" id="right_panle">

                                    <div id="chat_container">

                                    </div>
                                    <div class="flex-2 pt-4 ">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="write bg-white shadow flex rounded-lg">

                                                <div class="flex-1">
                                                    <textarea id="message" name="message" class="w-full block outline-none py-4 px-4 bg-transparent message-content"
                                                        rows="1" placeholder="Type a message..." autofocus></textarea>
                                                </div>
                                                <div class="flex-2 w-25 p-2 flex content-center items-center">
                                                    <div class="flex-1">
                                                        <button type="button"
                                                            class="bg-blue-400 w-10 h-10 rounded-full inline-block send-messsage"
                                                            onclick="sendMsg()">
                                                            <span class="inline-block align-text-bottom">
                                                                <svg fill="none" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" viewBox="0 0 24 24"
                                                                    class="w-6 h-6 text-white">
                                                                    <path d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".user-list").click(function() {
            $(".user-list").removeClass("active");
            $(this).addClass("active");
        });

        function getMessages(to_user_id) {
            $.ajax({
                type: "GET",
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                url: base_url + "/chat/messages/" + to_user_id,
                success: function(data) {
                    $('#right_panle').show();
                    $('#to_user_id').val(to_user_id);
                    $('#chat_container').html(data);

                    document.getElementById("messages").scrollTop = document.getElementById("messages")
                        .scrollHeight;

                },
                error: function(data, e) {
                    console.log("Something went wrong. Please try again later.");
                }
            });
        }

        function sendMsg() {
            var to_user_id = $('#to_user_id').val();
            var message = $('#message').val();
            $.ajax({
                type: "POST",
                data: {
                    'to_user_id': to_user_id,
                    'message': message
                },
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                url: base_url + "/chat/send/message",
                success: function(data) {
                    getMessages(to_user_id);
                    $('#message').val('');
                },
                error: function(data, e) {
                    console.log("Something went wrong. Please try again later.");
                }
            });
        }

        function deleteMsg(chat_id) {
            if (confirm('Are you sure to delete this message?')) {
                var to_user_id = $('#to_user_id').val();
                $.ajax({
                    type: "DELETE",
                    data: {},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    url: base_url + "/chat/message/delete/" + chat_id,
                    success: function(data) {
                        getMessages(to_user_id);
                    },
                    error: function(data, e) {
                        console.log("Something went wrong. Please try again later.");
                    }
                });
            }


        }


        setInterval(() => {
            var to_user_id = $('#to_user_id').val();
            if (to_user_id) {
                getMessages(to_user_id);
            }
        }, 1000);
    </script>

</x-app-layout>
