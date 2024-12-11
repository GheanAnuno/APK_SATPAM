<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (replace with your actual connection details)
    $servername = "localhost";
    $username = "root"; // Your DB username
    $password = ""; // Your DB password
    $dbname = "presensi"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from form
    $id_login = htmlspecialchars($_POST['id_login']);
    $username = htmlspecialchars($_POST['username']);
    $gender = htmlspecialchars($_POST['gender']);
    $password = htmlspecialchars($_POST['password']);

    // Simple validation (make sure all fields are filled)
    if (!empty($id_login) && !empty($username) && !empty($gender) && !empty($password)) {
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO login (id_login, Username, gender, Password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id_login, $username, $gender, $password);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: index.html");
            exit;
        } else {
            $error = "There was an error with your registration. Please try again.";
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Presensi</title>
</head>
<body class="bg-gray-900">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 w-96">
            <img
                src="logo.png"
                alt="logo"
                class="mx-auto h-20 w-20"
            />
            <h2 class="text-2xl font-bold mb-6 text-center">Register Presensi</h2>

            <?php if (isset($error)) { ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST" action="register.php">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_login">
                       Nama Lengkap
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="id_login"
                        type="text"
                        name="id_login"
                        placeholder="Masukkan Nama Lengkap"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                        Gender
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="gender"
                        name="gender"
                        required
                    >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    />
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Register
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-500 hover:text-blue-800" href="index.php">
                        Sudah Punya Akun? Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
