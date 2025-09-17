<?php
include '../include/header.php';
include "../include/connection.php";
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    echo "Access Denied";
    exit();
}
?>
<div class="mx-auto max-w-7xl">
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-white">Order Table Dashboard</h1>
    <div class="bg-gray-800 rounded-lg shadow-2xl overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Order_username</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Order_Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Order_Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Qty
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Products
                        Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Categorie</th>
                    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">

                <?php
                $query = "SELECT * FROM ordertable";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $pid = $row['pid'];
                    $pname = $row['pname'];
                    $price = $row['price'];
                    $discription = $row['discription'];
                    $image = $row['image'];
                    $qty = $row['qty'];
                    $categories = $row['categories'];
                    $date = $row['orderdate'];

                    $query = "SELECT * FROM users WHERE user_id='$user_id'";
                    $user_result = mysqli_query($con, $query);
                    while ($user_row = mysqli_fetch_assoc($user_result)) {
                        $user_name = $user_row["username"];
                        $email = $user_row["email"];
                    }


                    ?>
                    <tr class="bg-gray-800 hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap"><?= $user_name ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $email ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $date ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $pname ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $qty ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $price ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <div
                            class="block w-[45px] h-[45px] rounded-full overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform duration-200 transform hover:scale-105">
                            <img class="w-full h-full object-cover" src="../../images/items/<?= $image ?>"
                                alt="Profile photo">
                        </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $categories ?></td>
                        
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</div>


<?php
include '../include/footer.php';
?>