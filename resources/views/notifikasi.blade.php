<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
</head>
<body>
    <div class="container">
        <h1>Notifications</h1>
        <div class="notification-list">
            @forelse ($notifikasis as $notifikasi)
                <div class="notification-item">
                    <h2 class="notification-title">{{ $notifikasi->judul }}</h2>
                    <p class="notification-content">{{ $notifikasi->content }}</p>
                    <small class="notification-timestamp">{{ $notifikasi->timestamp }}</small>
                </div>
            @empty
                <p>No notifications available.</p>
            @endforelse
        </div>
    </div>

    <script src="{{ asset('js/notifications.js') }}"></script>
</body>
</html>
