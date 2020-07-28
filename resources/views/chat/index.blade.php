<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

</head>
<body class="container-fluid">
<div class="row">

    <div class="col-3 p-3 border">
        @if($logged)
            <form id="sendMessage" action="{{ route('chat.store') }}" method="post">
                @csrf
                <textarea id="message" required name="message" class="form-control mb-3" placeholder="Type text"></textarea>

                <ul class="list-unstyled">
                    <li>Login: {{ $logged['login'] }}</li>
                    <li>Email: {{ $logged['email'] }}</li>
                </ul>

                <input type="submit" class="btn btn-success" value="SEND">
                <a href="{{ route('chat.logout') }}" class="btn btn-danger">logout</a>
            </form>
        @else
            <form action="{{ route('chat.login') }}" method="post">
                @csrf
                <input required type="text" name="login" class="form-control mb-3" placeholder="login">
                <input required type="email" name="email" class="form-control mb-3" placeholder="email">
                <input type="submit" class="btn btn-success" value="Login in">
            </form>
        @endif

        <div class="row pt-3">
            <div class="col pt-3" style="border-top: 1px solid #000">
                @foreach($badWords as $badWord)
                    {{ $badWord->from .' => '. $badWord->to }} <br>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col border">
        <div class="row pre-scrollable">
            <ul id="messages-list" class="list-unstyled w-100">
                @foreach($messages as $message)
                    <li style="border-bottom: 1px solid #000">
                        Login: <b>{{ $message->login }}</b> <br>
                        Email: <b>{{ $message->email }}</b> <br>
                        Message <b>{{ $message->message }}</b></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script>
    let url = "{{ env('APP_URL') }}";
    let socket = io( url + ':3000');

    $('#sendMessage').submit(function(e) {
	    e.preventDefault(); // prevents page reloading

	    let data = {
		    '_token': '{{ csrf_token() }}',
		    'login': "{{ $logged['login'] }}",
		    'email': "{{ $logged['email'] }}",
		    'message': $('#message').val(),
	    };

	    $.ajax({
		    method: 'POST',
		    url: "{{ route('chat.store') }}",
		    data: data,
		    success: (resp) => {
			    socket.emit('chat-message', resp)
            }

	    });

	    $('#message').val('');
    });



    socket.on('chat-message', function(data){
        console.log(data)
        $('#messages-list').prepend(`
            <li style="border-bottom: 1px solid #000">
                Login: <b>${data.login}</b> <br>
                Email: <b>${data.email}</b> <br>
                Message <b>${data.message}</b></li>
        `);
    });
</script>

</body>
</html>
