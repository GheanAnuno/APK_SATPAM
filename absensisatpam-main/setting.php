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
    // Validasi input untuk menghindari error Undefined array key
    $idlogin = isset($_POST['id_login']) ? $_POST['id_login'] : '';
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $password = isset($_POST['Password']) ? $_POST['Password'] : '';

    // Cek apakah semua data tersedia
    if (!empty($idlogin) && !empty($username) && !empty($gender) && !empty($password)) 
    {
        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE login SET Username = ?, gender = ?, Password = ? WHERE id_login = ?");
        $stmt->bind_param("sssi", $username, $gender, $password, $idlogin);

        // Eksekusi query dan cek hasilnya
        if ($conn->query($sql) === TRUE) {
        $popupMessage = "Data absensi berhasil disimpan!";
        $popupType = "success";
    } 
    else {
        $popupMessage = "Error: " . $conn->error;
        $popupType = "error";
    }
}
?>


$sql = "SELECT * FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Update</title>
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
        <h1 class="text-4xl font-extrabold text-center text-blue-400 mb-6">Pengaturan Akun</h1>

        <!-- Form -->
        <form id="absensiForm" action="setting.php" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
             <div>
                    <label for="noPegawai" class="block text-sm font-medium text-blue-500">Username</label>
                    <input
                        type="text"
                        name="Username"
                        id="Username"
                        class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>   
            <div>
                    <label for="noPegawai" class="block text-sm font-medium text-blue-500">Password</label>
                    <input
                        type="password"
                        name="Password"
                        id="Password"
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
</body>
</html>