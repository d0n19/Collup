<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $room->name }}</title>
</head>
<body>
    <h1>{{ $room->name }}</h1>
    <a href="/chats">Back to list</a>

    <div>
        @foreach($messages as $message)
            <p>{{ $message->content }}</p>
        @endforeach
    </div>

    <form action="/chats/{{ $room->id }}/messages" method="POST">
        @csrf
        <input type="text" name="content" required>
        <button type="submit">Send</button>
    </form>
</body>
</html>