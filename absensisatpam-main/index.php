<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "presensi"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$login_error = ''; // Pesan error login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencocokkan username dan password
    $sql = "SELECT * FROM login WHERE Username = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika ada hasil, login berhasil
    if ($result->num_rows > 0) {
        header("Location: DashBoard.html"); // Redirect ke dashboard
        exit();
    } else {
        $login_error = "Username atau password salah!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Presensi</title>
    <style>
      body {
        background: linear-gradient(45deg, #b0bec5, #78909c, #37474f);
        background-size: 400% 400%;
        animation: gradientAnimation 15s ease infinite;
        color: white;
      }

      @keyframes gradientAnimation {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

      .btn {
        position: relative;
        overflow: hidden;
        display: inline-block;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 12px 24px;
        border: 2px solid #f39c12;
        color: white;
        background-color: #1f1f1f;
        text-align: center;
        cursor: pointer;
        border-radius: 50px;
        transition: all 0.4s;
        box-shadow: 0px 0px 10px rgba(243, 156, 18, 0.5);
      }

      .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300%;
        height: 300%;
        background-color: #f39c12;
        transition: all 0.4s;
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(1);
      }

      .btn:hover::before {
        transform: translate(-50%, -50%) scale(0);
      }

      .btn:hover {
        background-color: #f39c12;
        color: #1f1f1f;
      }

      .input-field {
        transition: border-color 0.3s ease-in-out;
      }

      .input-field:focus {
        border-color: #f39c12;
        box-shadow: 0 0 10px rgba(243, 156, 18, 0.8);
      }

      .input-field::placeholder {
        color: #999;
      }

      .input-field:focus::placeholder {
        color: #f39c12;
      }
    </style>
  </head>
  <body class="flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-10 w-96 transform hover:scale-105 transition-all duration-500">
      <img
        src="satpamkirek.jpg"
        alt="logo"
        class="mx-auto h-20 w-20 mb-6 transform hover:rotate-6 transition-all duration-500"
      />
      <h2 class="text-3xl font-extrabold mb-6 text-center text-gradient">Login Presensi</h2>

      <form method="POST" action="index.php">
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Username
          </label>
          <input
            class="input-field shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            id="username"
            type="text"
            name="username"
            placeholder="Masukkan username"
            required
          />
        </div>
        <div class="mb-8">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input
            class="input-field shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            id="password"
            type="password"
            name="password"
            placeholder="Masukkan password"
            required
          />
          <a class="inline-block text-sm text-blue-500 hover:text-blue-800" href="register.php">
            Belum Punya Akun
          </a>
        </div>

        <div class="flex items-center justify-between">
          <button
            class="btn"
            type="submit"
          >
            <a href="DashBoard.html">Login</a>
          </button>
          <a class="inline-block text-sm text-blue-500 hover:text-blue-800" href="">
            Lupa password?
          </a>
        </div>
      </form>
    </div>

    <script>
      // Check for login error from PHP
      const errorMessage = "<?php echo isset($login_error) ? $login_error : ''; ?>";
      if (errorMessage) {
        document.getElementById("error-message").classList.remove("hidden");
      }
    </script>
  </body>
</html>
