<?php
// Koneksi ke MySQL
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "presensi"; 

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

$popupMessage = ""; // Variabel untuk pesan pop-up
$popupType = ""; // Variabel untuk jenis pop-up

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noPegawai = $_POST['Nomor_Pegawai'];
    $nama = $_POST['Nama_Satpam'];
    $pengajuan = $_POST['Pengajuan_Cuti'];
    $alasan = $_POST['Alasan'];
    $Validasi = $_POST['Validasi'];
    $sql = "INSERT INTO perizinan (Nomor_Pegawai,Nama_Satpam, Pengajuan_Cuti, Alasan, Validasi)
            VALUES ( '$nama', '$pengajuan', '$lasan')";

    if ($conn->query($sql) === TRUE) {
        $popupMessage = "Data absensi berhasil disimpan!";
        $popupType = "success";
    } else {
        $popupMessage = "Error: " . $conn->error;
        $popupType = "error";
    }
}

$sql = "SELECT * FROM absen";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-900 font-sans text-gray-200">

    <!-- SweetAlert2 Pop-up -->
    <?php if (!empty($popupMessage)): ?>
    <script>
        Swal.fire({
            title: '<?php echo $popupMessage; ?>',
            icon: '<?php echo $popupType; ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2563EB',
        });
    </script>
    <?php endif; ?>

    <!-- Container -->
    <div class="container mx-auto p-6 max-w-4xl">
        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-center text-blue-400 mb-6">Form Pengajuan</h1>

        <!-- Form -->
        <form id="absensiForm" action="absen.php" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
               
                <div>
                    <label for="nama" class="block text-sm font-medium text-blue-500">Nama Satpam</label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>
                <div>
                    <label for="shift" class="block text-sm font-medium text-blue-500">Pengajuan</label>
                    <select
                        name="shift"
                        id="shift"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="Pagi">Cuti</option>
                        <option value="Malam">Ganti Libur</option>
                         <option value="Malam">Ganti Shift</option>
                    </select>
                </div>
                <div>
                    <label for="nama" class="block text-sm font-medium text-blue-500">Alasan</label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>
                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full py-3 text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-lg shadow-lg transition duration-300"
                >
                    Submit
                </button>
                 <div class="flex justify-start mt-6">
            <a href="DashBoard.html" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kembali
            </a>
        </div>
            </div>
        </form>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
