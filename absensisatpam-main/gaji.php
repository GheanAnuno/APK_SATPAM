<?php

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "presensi"; 

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari tabel jadwal
$sql = "SELECT * FROM gaji";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Gaji Satpam</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">
            Gaji Satpam
        </h1>

        <!-- Tabel -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead>
                    <tr class="bg-gray-800">
                         <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">ID Gaji</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nama Satpam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Jumlah Gaji</th>
                        
                      
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='hover:bg-gray-100'>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["id_Gaji"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["Nama_Satpam"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["Jumlah_Gaji"] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='px-6 py-4 text-gray-800 text-center'>No data found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tombol -->
        <div class="flex justify-start mt-6">
            <a href="DashBoard.html" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
