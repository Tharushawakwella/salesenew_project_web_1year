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
    <div class="text-center mb-8">
        <button onclick="generatePDF()"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors duration-300">
            PDF Download
        </button>
    </div>
    <div class="bg-gray-800 rounded-lg shadow-2xl overflow-x-auto">
        <table id="myTable" class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Order_username</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Order_Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Order_Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product
                        Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Qty
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">total
                        price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Product_ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Seller Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Product Bissness Name</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <?php
                $totalIncome = 0;
                $query = "SELECT * FROM orderhistory";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $pname = $row['pnames'];
                    $price = $row['totalprice'];
                    $qty = $row['qty'];
                    $order_id = $row['orderid'];
                    $date = $row['date'];
                    $pid = $row['pid'];

                    $totalIncome += $price;

                    $query = "SELECT * FROM production WHERE pid='$pid'";
                    $product_result = mysqli_query($con, $query);
                    while ($product_row = mysqli_fetch_assoc($product_result)) {
                        $seller_id = $product_row['user_id'];
                        
                        $query = "SELECT * FROM users WHERE user_id='$seller_id'";
                        $seller_result = mysqli_query($con, $query);
                        while ($seller_row = mysqli_fetch_assoc($seller_result)) {
                            $seller_name = $seller_row['username'];
                        }
                        $query = "SELECT * FROM businessregistration WHERE user_id='$seller_id'";
                        $business_result = mysqli_query($con, $query);
                        while ($business_row = mysqli_fetch_assoc($business_result)) {
                            $business_name = $business_row['bname'];
                        }
                    }
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
                    <td class="px-6 py-4 whitespace-nowrap"><?= $pid ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $seller_name ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $business_name ?></td>
                </tr>
                <style>
                    h3 {
                        font-weight: bold;
                        font-size: 1.25rem;
                        color: #f9f9f9ff;
                    }
                </style>
                <h3>Total Income: LKR.<?= $totalIncome ?></h3>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const element = document.getElementById('myTable'); 

    html2canvas(element, {
        scale: 2, 
        useCORS: true, // This is important if your images are from a different domain
    }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const imgWidth = 210; 
        const pageHeight = 297;  
        const imgHeight = canvas.height * imgWidth / canvas.width;
        let heightLeft = imgHeight;
        let position = 0;

        // Add a title to the PDF
        pdf.text('Order Table Report', 105, 15, null, null, 'center');
        
        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        // Handle multiple pages if the table is very long
        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        pdf.save('order_table.pdf');
    });
}
</script>

<?php
include '../include/footer.php';
?>