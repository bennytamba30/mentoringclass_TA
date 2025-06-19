{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - LMS Mentoring</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1" for="email">Email</label>
                <input class="w-full border rounded px-3 py-2" type="email" name="email" id="email"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="block mb-1" for="password">Password</label>
                <input class="w-full border rounded px-3 py-2" type="password" name="password" id="password" required>
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition"
                type="submit">Login</button>
        </form>
    </div>
</body>

</html> --}}
