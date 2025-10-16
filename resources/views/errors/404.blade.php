<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/icon/icon.svg') }}">
    <title>Halaman Tidak Ditemukan</title>

    {{-- ✅ Google Fonts: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        .icon {
            font-size: 100px;
            color: #0d6efd;
            margin-bottom: 20px;
            animation: float 2.5s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            max-width: 500px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        a.button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #6ea5fb;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: transparent;
            border: 2px solid #6ea5fb;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Gambar ilustrasi 404 (ganti URL-nya sesuai file kamu) --}}
        <img src="{{ asset('assets/icon/404.png') }}" alt="404 Not Found Illustration">

        <h1>Halaman Tidak Ditemukan!</h1>
        <p>Yah, halaman tidak ditemukan. Coba cek lagi URL yang kamu masukkan atau klik menu di bawah ini ya.</p>
        <a href="{{ url('/') }}" class="button"> Kembali Ke Beranda</a>
    </div>
</body>
</html>
