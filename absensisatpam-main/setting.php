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

// Ambil data dari tabel login
$sql = "SELECT * FROM login";
$result = $conn->query($sql);

// Proses Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateData"])) {
    $id_login = $_POST["id_login"]; // ID lama
    $id_login_new = $_POST["id_login_new"]; // ID baru
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];

    $updateQuery = "UPDATE login SET id_login='$id_login_new', Username='$username', gender='$gender', Password='$password' WHERE id_login='$id_login'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='setting.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setting</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">
            Setting
        </h1>

        <!-- Tabel -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">NAME</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">USERNAME</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">GENDER</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">PASSWORD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='hover:bg-gray-100'>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["id_login"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["Username"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["gender"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>" . $row["Password"] . "</td>
                                    <td class='px-6 py-4 text-gray-800'>
                                        <button 
                                            class='bg-transparent hover:bg-blue-500 hover:text-white text-blue-500 font-medium py-2 px-4 rounded-lg border border-blue-500 hover:border-transparent focus:outline-none transition-all duration-300 ease-in-out flex items-center space-x-2'
                                            onclick='openModal(" . json_encode($row) . ")'>
                                            <svg xmlns='http://www.w3.org/2000/svg' class='w-5 h-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 4h6v6M8 16l4-4m0 0l8-8m-8 8L4 16' />
                                            </svg>
                                            <span>Edit</span>
                                        </button>
                                    </td>
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

    <!-- Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data</h2>
            <form action="setting.php" method="POST" class="space-y-4">
                <input type="hidden" name="id_login" id="modalIdLogin" />

                <div>
                    <label for="id_login" class="block text-sm font-medium text-gray-700">ID Login</label>
                    <input type="text" name="id_login_new" id="modalIdLoginNew" class="w-full mt-1 px-4 py-2 border rounded-lg" required />
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="modalUsername" class="w-full mt-1 px-4 py-2 border rounded-lg" required />
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="modalGender" class="w-full mt-1 px-4 py-2 border rounded-lg" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Tidak Menyebutkan">Tidak Menyebutkan</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="modalPassword" class="w-full mt-1 px-4 py-2 border rounded-lg" required />
                </div>
                <button type="submit" name="updateData" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg shadow-md">
                    Update
                </button>
                <button type="button" onclick="closeModal()" class="w-full mt-2 bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-lg shadow-md">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const modal = document.getElementById("editModal");

        function openModal(row) {
            document.getElementById("modalIdLogin").value = row.id_login; 
            document.getElementById("modalIdLoginNew").value = row.id_login; 
            document.getElementById("modalUsername").value = row.Username;
            document.getElementById("modalGender").value = row.gender;
            document.getElementById("modalPassword").value = row.Password;
            modal.classList.remove("hidden");
        }


        function closeModal() {
            modal.classList.add("hidden");
        }
    </script>
</body>
</html>
