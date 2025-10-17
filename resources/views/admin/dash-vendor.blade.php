

@section('content')
    <style>
        /* Custom styles for the dashboard */
        body {
            background-color: #f8f9fa;  /* Light gray for overall page */
        }
        .dashboard-container {
            background-color: #FFBF00;  /* Yellow-orange as the main background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Add some shadow for a cool effect */
            color: #fff;  /* White text for contrast on yellow-orange */
        }
        .blue-accent {
            color: #007BFF;  /* Blue for text and accents */
        }
        .btn-blue {
            background-color: #007BFF;  /* Blue buttons */
            border-color: #007BFF;
            color: #fff;
        }
        .btn-blue:hover {
            background-color: #0056b3;  /* Darker blue on hover */
            border-color: #0056b3;
        }
        /* Add more styles as needed for a keren look */
    </style>

    <div class="container mt-5">
        <div class="dashboard-container">
            <h1 class="blue-accent">Selamat Datang di Dashboard Admin</h1>  @endsection
            <p>Ini adalah panel admin Anda yang keren dengan warna kuning-oranye dan biru. Anda bisa menambahkan fitur seperti grafik, tabel, dan pengelolaan data di sini.</p>

            <!-- Example of a cool card section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-light p-3 text-center">
                        <h5 class="blue-accent">Total Pengguna</h5>
                        <p>{{ \App\Models\User::count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light p-3 text-center">
                        <h5 class="blue-accent">Postingan Terbaru</h5>
                        <p>10</p>  <!-- You can replace this with dynamic data -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light p-3 text-center">
                        <h5 class="blue-accent">Laporan</h5>
                        <p>5</p>
                    </div>
                </div>
            </div>

            <!-- Add a button with blue style -->
            <div class="mt-4">
                <a href="#" class="btn btn-blue">Lihat Laporan Lengkap</a>
            </div>
        </div>
    </div>
