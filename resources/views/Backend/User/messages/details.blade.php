@extends('frontend.layouts.master')



@section('main-content')
    <style>
        .chat-container {
            height: 90vh;
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #fff;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }
        .chat-input {
            border-top: 1px solid #dee2e6;
            padding: 0.75rem;
        }
        .message {
            max-width: 75%;
        }
        .sent {
            text-align: end;
        }
        .sent .bubble {
            background-color: #2c7a7b;
            color: white;
        }
        .received .bubble {
            background-color: #f1f1f1;
        }
        .bubble {
            display: inline-block;
            padding: 0.6rem 1rem;
            border-radius: 1rem;
            margin-bottom: 0.25rem;
        }
        .chat-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        .sub-color{
            background-color:#2c7a7b;
        }
        .sub-color:hover{
            background-color:#2c7a7b;
        }
        .chat-messages-wrapper {
            height: 500px; /* You can change this to fit your layout */
            overflow-y: auto;
            padding: 10px;
            background-color: #fdfdfd;
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Customer Live Chat Box</h1>
              <p class="mb-0">
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="current">Customer Chat Box</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <div class="container">
    <div class="row">

      <!-- Sidebar -->

      @include('backend.user.sidebar')

            <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4"  data-aos="fade-up" data-aos-delay="200">
            <!-- Messages Area -->
@php
    $mergedMessages = collect();

    // First user message
    if ($message !== null) {
        $message->type = 'sent';
        $mergedMessages->push($message);
    }

    // More user messages
    foreach ($conversations as $chat) {
        $chat->type = 'sent';
        $mergedMessages->push($chat);
    }

    // Agent messages
    foreach ($reply_conversations as $chat) {
        $chat->type = 'received';
        $mergedMessages->push($chat);
    }

    // Sort all messages by time
    $mergedMessages = $mergedMessages->sortBy('created_at');
@endphp


<div class="chat-messages-wrapper" id="chat-scroll">
    @foreach ($mergedMessages as $chat)
        <div class="mb-3 {{ $chat->type }}">
            <div class="d-flex {{ $chat->type == 'received' ? 'align-items-start gap-2' : 'justify-content-end' }}">

                {{-- Agent Avatar --}}
                @if ($chat->type == 'received')
                    <img src="{{ asset('uploads/agent/' . $agent->photo) }}" class="chat-avatar" alt="Agent">
                @endif

                <div>
                    {{-- Message Bubble --}}
                    <div class="bubble">
                        {{-- TEXT --}}
                        @if (!empty($chat->message_body))
                            {{ $chat->message_body }}
                        @elseif (!empty($chat->conversation_body))
                            {{ $chat->conversation_body }}
                        @elseif (!empty($chat->reply_conversation_body))
                            {{ $chat->reply_conversation_body }}
                        @else
                            <em>No message text</em>
                        @endif

                        {{-- IMAGE --}}
                        @if (!empty($chat->file))
                            <div class="mt-2">
                                <img src="{{ asset('uploads/users/messages/' . $chat->file) }}" alt="Image" style="width: 100px;">
                            </div>
                        @elseif (!empty($chat->conversation_file))
                            <div class="mt-2">
                                <img src="{{ asset('uploads/users/messages/conversation/' . $chat->conversation_file) }}" alt="Image" style="width: 200px;">
                            </div>
                        @elseif (!empty($chat->reply_conversation_file))
                            <div class="mt-2">
                                <img src="{{ asset('uploads/users/messages/conversation/' . $chat->reply_conversation_file) }}" alt="Image" style="width: 200px;">
                            </div>
                        @endif
                    </div>

                    {{-- Time --}}
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($chat->created_at)->timezone('Asia/Dhaka')->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach
</div>


    <!-- Input Area -->
    <div class="chat-input">
        <form class="d-flex gap-2" action="{{ route('message_conversation',$message->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="file-upload" class="upload-icon" style="cursor: pointer; margin-bottom: 0;">
                <i class="bi bi-image file_color fs-5" style="color: #2c7a7b;"></i>
            </label>
            <input id="file-upload" type="file" name="file" style="display: none;">
            <input type="hidden" class="form-control" name="agent_id" value="{{ $message->agent_id }}">
            <textarea name="conversation_body" id="message-input" rows="1" placeholder="Type a message..." class="form-control"></textarea>
            <button class="btn btn-primary sub-color" type="submit"><i class="bi bi-send-fill"></i></button>
        </form>
    </div>
      </div>

    </div>
  </div>
  </main>
<script>
    window.addEventListener('load', function () {
        const chatScroll = document.getElementById('chat-scroll');
        if (chatScroll) {
            chatScroll.scrollTop = chatScroll.scrollHeight;
        }
    });
</script>
@endsection




