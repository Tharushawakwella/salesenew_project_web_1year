<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>



<body class="bg-black text-white">
    <div class="flex h-screen">
        <?php if (isset($_SESSION['type'])) { ?>
            <?php if ($_SESSION['type'] == 'admin') { ?>
                <div class="w-1/4 bg-black p-5 flex flex-col">
                    <div
                        class="block w-[45px] h-[45px] rounded-full overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform duration-200 transform hover:scale-105">
                        <img class="w-full h-full object-cover"
                            src="../../images/profile_images/<?php echo $_SESSION['image']; ?>" alt="Profile photo">
                    </div>
                    <div class="text-xl font-bold mb-1">Admin Page</div>
                    <p class="text-white/75 mb-6">welcome <?php echo htmlspecialchars($_SESSION['username']); ?></p>

                    <nav class="flex flex-col space-y-2">
                        <a href="../pages/manage.php" class="custom-link text-black py-4 px-4 rounded-md">supplier manage</a>
                        <a href="../pages/prodouct.php" class="custom-link text-black py-4 px-4 rounded-md">Production
                            Management</a>
                        <a href="../pages/ordertable.php" class="custom-link text-black py-4 px-4 rounded-md">Order table</a>
                        <a href="../pages/history.php" class="custom-link text-black py-4 px-4 rounded-md">Order History</a>
                    </nav>
                    <a href="logout.php"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded mb-6 text-center transition-colors duration-200 mt-6">Log
                        Out</a>
                </div>
            <?php } ?>
        <?php } else {
            echo "Access Denied";
        } ?>
        <div class="w-3/4 bg-black p-5 h-screen">
            <!-- Main content goes here -->