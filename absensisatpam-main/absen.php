<?php
// Koneksi ke MySQL
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "satpam"; 

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

$popupMessage = ""; // Variabel untuk pesan pop-up
$popupType = ""; // Variabel untuk jenis pop-up

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noPegawai = $_POST['noPegawai'];
    $nama = $_POST['nama'];
    $shift = $_POST['shift'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO absensi (noPegawai, nama, shift, gender)
            VALUES ('$noPegawai', '$nama', '$shift', '$gender')";

    if ($conn->query($sql) === TRUE) {
        $popupMessage = "Data absensi berhasil disimpan!";
        $popupType = "success";
    } else {
        $popupMessage = "Error: " . $conn->error;
        $popupType = "error";
    }
}

$sql = "SELECT * FROM absensi";
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
        <h1 class="text-4xl font-extrabold text-center text-blue-400 mb-6">Form Absensi</h1>

        <!-- Form -->
        <form id="absensiForm" action="absen.php" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
                <div>
                    <label for="noPegawai" class="block text-sm font-medium text-blue-500">Nomor Pegawai</label>
                    <input
                        type="text"
                        name="noPegawai"
                        id="noPegawai"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>
                <div>
                    <label for="nama" class="block text-sm font-medium text-blue-500">Nama</label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>
                <div>
                    <label for="shift" class="block text-sm font-medium text-blue-500">Shift</label>
                    <select
                        name="shift"
                        id="shift"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="Pagi">Pagi</option>
                        <option value="Malam">Malam</option>
                    </select>
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-blue-500">Gender</label>
                    <select
                        name="gender"
                        id="gender"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Tidak Menyebutkan">Tidak Menyebutkan</option>
                    </select>
                </div>
                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full py-3 text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-lg shadow-lg transition duration-300"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
