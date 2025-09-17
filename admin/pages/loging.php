<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container">
        <main class="w-full max-w-md mx-auto p-8 rounded-xl shadow-2xl bg-white">
            <section id="login-page" class="space-y-6">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Admin Login</h1>
                    <p class="mt-2 text-sm text-gray-500">Enter your credentials to access the dashboard.</p>
                    <p class="mt-1 text-xs text-blue-500 font-medium">
                        (Use 'admin' for username and 'password' for password)
                    </p>
                </div>

                <form class="space-y-4" action="../lib/login-backend.php" method="post">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username OR Email</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit" id="login-button" name="login"
                            class="w-full py-3 px-4 rounded-lg bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Login
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_GET['error'])) {
                    $error_message = match ($_GET['error']) {
                        'User_Name' => 'User name is required!',
                        'Password' => 'Password is required!',
                        'account_error' => 'Only login as admin only',
                        'login_error' => 'Email or password is incorrect!',
                        default => null,
                    };
                } else {
                    $error_message = null;
                }
                ?>
                <?php if (!empty($error_message)) { ?>
                    <div class="mt-4">
                        <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                            <button type="button" onclick="this.parentElement.style.display='none';"
                                class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 8.586l-2.934 2.934a1 1 0 101.414 1.414L10 9.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </main>
    </div>

    <script>
        window.onload = function () {
            if (window.history.replaceState) {
                const url = new URL(window.location.href);
                url.searchParams.delete('error');
                window.history.replaceState({ path: url.href }, '', url.href);
            }
        };
    </script>
</body>

</html>