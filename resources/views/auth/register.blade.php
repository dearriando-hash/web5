<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border p-2 rounded mt-1">
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" required class="w-full border p-2 rounded mt-1">
            </div>
            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" required class="w-full border p-2 rounded mt-1">
            </div>
            <div>
                <label class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full border p-2 rounded mt-1">
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar</button>
        </form>
        <p class="text-xs text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600">Login</a></p>
    </div>
</body>
</html>