<?php
include '../include/header.php';
include "../include/connection.php";
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    echo "Access Denied";
    exit();
}
?>
<div class="mx-auto max-w-7xl">
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-white">Product Dashboard</h1>
    <div class="bg-gray-800 rounded-lg shadow-2xl overflow-x-auto">
        <table class="min-w-full divide-y divide-black-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Upload
                        Business Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Upload Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Id</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        Discription</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Qty
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Categorie
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">

                <?php
                $query = "SELECT * FROM production";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $pid= $row['pid'];
                    $pname = $row['pname'];
                    $price = $row['price'];
                    $discription = $row['discription'];
                    $image = $row['image'];
                    $qty = $row['qty'];
                    $categories = $row['categories'];
                    $date = $row['Add_date'];

                    $query = "SELECT * FROM businessregistration WHERE user_id='$user_id'";
                    $user_result = mysqli_query($con, $query);
                    while ($user_row = mysqli_fetch_assoc($user_result)) {
                        $bname = $user_row["bname"];
                    }



                    ?>
                    <tr class="bg-gray-800 hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap"><?= $bname ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $date ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $pname ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $pid ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $price ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $discription ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div
                                class="block w-[45px] h-[45px] rounded-full overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform duration-200 transform hover:scale-105">
                                <img class="w-full h-full object-cover" src="../../images/items/<?= $image ?>"
                                    alt="Profile photo">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $qty ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $categories ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">

                            <a href="../lib/delete.php?pid=<?= $pid ?>&user_id=<?= $user_id ?>" class="text-red-500 hover:underline hover:text-red-700 font-semibold transition-colors duration-150" onclick="return confirm('Are you sure ?')">Delete</a>

                        </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</div>


<?php
include '../include/footer.php';
?>