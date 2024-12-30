<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "satpam";

//konek

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM profil";
$result = $conn->query($sql);

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Profil Satpam</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-900">

    <!-- Main container -->
    <div class="container mx-auto p-6 flex justify-center items-center min-h-screen">
      
      <!-- Profile Card -->
      <div class="bg-gray-800 text-white rounded-xl shadow-lg max-w-lg w-full p-8 space-y-6">
        
        <!-- Profile Picture -->
        <div class="flex justify-center">
          <img src="gambar/satpamgta.png" alt="Profil Satpam" class="rounded-full w-32 h-32 object-cover border-4 border-blue-500" />
        </div>
        
        <!-- Name and Info -->
        <h2 class="text-3xl font-semibold text-center text-blue-400">
        <?= $data ? htmlspecialchars($data['nama']) : 'Tidak Ada Data'; ?>
        </h2>
        
        <div class="space-y-4">
          <div class="flex justify-between text-sm">
            <p class="font-medium">Nama :</p>
            <p>
            <?= $data ? htmlspecialchars($data['nama']) : 'Tidak Ada Data'; ?>
            </p>
          </div>
          <div class="flex justify-between text-sm">
            <p class="font-medium">Nomor HP :</p>
            <p>
            <?= $data ? htmlspecialchars($data['no_hp']) : 'Tidak Ada Data'; ?>
            </p>
          </div>
          <div class="flex justify-between text-sm">
            <p class="font-medium">Gender :</p>
            <p>
            <?= $data ? htmlspecialchars($data['gender']) : 'Tidak Ada Data'; ?>
            </p>
          </div>
        </div>
        
        <!-- Back Button -->
        <div class="flex justify-center">
          <a
          href="DashBoard.html"
          class="py-2 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md"
        >
          Kembali
        </a>
        </div>
      </div>

    </div>
  </body>
</html>
