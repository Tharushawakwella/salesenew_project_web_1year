<?php
include '../include/header.php';
include "../include/connection.php";
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    echo "Access Denied";
    exit();
}
?>
<div class="mx-auto max-w-7xl">
  <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-white">supplier Management Dashboard</h1>
  <div class="bg-gray-800 rounded-lg shadow-2xl overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-700">
      <thead class="bg-gray-700">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Submit user_email</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Name</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Register Date</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Number</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Register ID Number</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Types</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">PDF Link</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Logo</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Approve</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-700">

        <?php
        $query = "SELECT * FROM businessregistration";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $user_id = $row['user_id'];
          $bname = $row['bname'];
          $date = $row['date'];
          $bregid = $row['bregid'];
          $bnumber = $row['bnumber'];
          $btype = $row['btype'];
          $bcertificate = $row['bcertificate'];
          $blogo = $row['blogo'];
          $approve = $row['approve'];

          $query = "SELECT * FROM users WHERE user_id='$user_id'";
          $user_result = mysqli_query($con, $query);
          while($user_row = mysqli_fetch_assoc($user_result)){
            $user_email = $user_row['email'];
          }
        


        ?>
        <tr class="bg-gray-800 hover:bg-gray-700">
          <td class="px-6 py-4 whitespace-nowrap"><?= $user_email ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?= $bname ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?= $date ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?= $bnumber ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?= $bregid ?></td>
          <td class="px-6 py-4 whitespace-nowrap"><?= $btype ?></td>
          <td class="px-6 py-4 whitespace-nowrap">
            <a href="../../files/certificate/<?= $bcertificate ?>" target="_blank" class="text-blue-400 hover:underline">Details</a>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div
              class="block w-[45px] h-[45px] rounded-full overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform duration-200 transform hover:scale-105">
              <img class="w-full h-full object-cover"
                src="../../images/logo/<?= $blogo ?>" alt="Profile photo">
            </div>
          </td>
            <td class="px-6 py-4 whitespace-nowrap">
            <?php if ($approve == '0') { ?>
              <a href="../lib/approve.php?id=<?= $row['id'] ?>" class="text-green-400 hover:underline">YES</a>
            <?php } else { ?>
              <a href="../lib/Deapprove.php?id=<?= $row['id'] ?>" class="text-red-400 hover:underline">NO</a>
            <?php } ?>
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