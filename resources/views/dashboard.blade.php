<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-6">
        <!-- Header -->
        <div class="flex justify-between items-center pb-4 mb-6 border-b">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Halo, {{ $user->name }} 👋</h1>
                <p class="text-xs text-gray-500">{{ $user->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-1.5 rounded-lg transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-green-50 text-green-600 border border-green-200 text-sm p-3 rounded-lg mb-6 text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Upload Foto -->
        <form action="{{ route('update.foto') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Preview Foto -->
            <div class="flex flex-col items-center">
                <div class="relative w-36 h-36 mb-3">
                    <img id="imagePreview" 
                         src="{{ $user->foto ? Storage::url($user->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=3b82f6&color=fff&size=200' }}" 
                         alt="Foto Profil" 
                         class="w-36 h-36 rounded-full object-cover border-4 border-blue-500 shadow-md">
                </div>
                <span class="text-xs font-medium text-gray-500">
                    {{ $user->foto ? 'Foto Profil Saat Ini' : 'Belum Ada Foto Profil' }}
                </span>
            </div>

            <!-- Input File -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Foto Profil Baru</label>
                <input type="file" 
                       name="foto" 
                       id="fotoInput" 
                       accept="image/*" 
                       required 
                       onchange="previewFile()"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                
                @error('foto')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow transition">
                Simpan Foto Profil
            </button>
        </form>
    </div>

    <!-- Script Preview Gambar Otomatis -->
    <script>
        function previewFile() {
            const file = document.getElementById('fotoInput').files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>