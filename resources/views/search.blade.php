
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User</title>
    <style>
        /* Tambahkan beberapa style sederhana */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-results {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Search User</h1>
    
    <!-- Form Pencarian -->
    <form class="search-form" action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search User by Username" value="{{ request('query') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Tampilkan Hasil Pencarian -->
    <div class="search-results">
        @if(isset($users) && $users->count() > 0)
            <ul>
                @foreach($users as $user)
                    <li>{{ $user->name }} ({{ $user->username }})</li>
                @endforeach
            </ul>
        @else
            <p>No users found.</p>
        @endif
    </div>
</body>
</html>
