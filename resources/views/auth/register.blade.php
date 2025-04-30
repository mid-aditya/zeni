<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PUSDIKZI</title>
    <link rel="icon" type="image/png" href="/assets/images/logo-zeni.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --color-dark-green: #1B4D3E;
            --color-green: #4B7355;
            --color-light-green: #6B8C6E;
            --color-white: #FFFFFF;
        }
        .gradient-text {
            background: linear-gradient(45deg, var(--color-dark-green), var(--color-light-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .auth-container {
            background: linear-gradient(135deg, rgba(27, 77, 62, 0.9), rgba(75, 115, 85, 0.9));
        }
        .input-field {
            border: 2px solid var(--color-light-green);
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: var(--color-dark-green);
            box-shadow: 0 0 0 3px rgba(27, 77, 62, 0.1);
        }
        .submit-button {
            background: var(--color-dark-green);
            transition: all 0.3s ease;
        }
        .submit-button:hover {
            background: var(--color-green);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <img src="/assets/images/logo-zeni.png" alt="Logo Zeni" class="mx-auto h-24 w-auto">
                <h2 class="mt-6 text-3xl font-bold gradient-text">
                    Daftar Akun Baru
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Buat akun untuk mengakses layanan PUSDIKZI
                </p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="nrp" class="sr-only">NRP</label>
                        <input id="nrp" name="nrp" type="text" required maxlength="8" pattern="[A-Za-z0-9]{8}" class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field rounded-t-md focus:outline-none focus:z-10 sm:text-sm" placeholder="NRP (8 karakter)">
                    </div>
                    <div>
                        <label for="nama" class="sr-only">Nama Lengkap</label>
                        <input id="nama" name="nama" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field focus:outline-none focus:z-10 sm:text-sm" placeholder="Nama Lengkap">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="sr-only">Tanggal Lahir</label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" required class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field focus:outline-none focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field focus:outline-none focus:z-10 sm:text-sm" placeholder="Email">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required minlength="8" class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field focus:outline-none focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field rounded-b-md focus:outline-none focus:z-10 sm:text-sm" placeholder="Konfirmasi Password">
                    </div>
                    <div>
                        <label for="role" class="sr-only">Role</label>
                        <select id="role" name="role" required class="appearance-none rounded-none relative block w-full px-3 py-2 border input-field focus:outline-none focus:z-10 sm:text-sm">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="siswa">Siswa</option>
                            <option value="pelatih">Pelatih</option>
                            <option value="anggota">Anggota</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-[#1B4D3E] focus:ring-[#1B4D3E] border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        Saya setuju dengan <a href="#" class="text-[#1B4D3E] hover:text-[#4B7355]">Syarat dan Ketentuan</a>
                    </label>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white submit-button focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4D3E]">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-[#1B4D3E] hover:text-[#4B7355]">
                        Masuk sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html> 