<?php

include 'config.php';

// Number of records per page
$records_per_page = 5;

// Get the current page number from the URL, default to page 1
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the current page
$start_from = ($current_page - 1) * $records_per_page;

// Query to fetch records for the current page
$sql = "SELECT * FROM nhanvien LIMIT $start_from, $records_per_page";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>List Nhan vien</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Ma NV</th><th>Ten NV</th><th>Phai</th><th>Noi sinh</th><th>Ma phong</th><th>Luong</th><th>Action</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row["Ma_NV"]."</td>";
        echo "<td>".$row["Ten_NV"]."</td>";
        echo "<td>";
        if ($row["Phai"] == "NAM") {
            echo "<img src='images/men.png'  width='50' height='50'>";
        } else if ($row["Phai"] == "NU") {
            echo "<img src='images/women.png'  width='50' height='50'>";
        }
        echo "</td>";
        echo "<td>".$row["Noi_Sinh"]."</td>";
        echo "<td>".$row["Ma_Phong"]."</td>";
        echo "<td>".$row["Luong"]."</td>";
        echo "<td>";
        echo "<a href='edit_NV.php?id=".$row["Ma_NV"]."'>Sửa</a> | ";
        echo "<a href='del_NV.php?id=".$row["Ma_NV"]."'>Xóa</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Pagination links
    $sql = "SELECT COUNT(*) AS total FROM nhanvien";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<br>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i'>$i</a> ";
    }

    // Add button
    echo "<br><br>";
    echo "<a href='add_NV.php'>Thêm Nhân viên</a>";
} else {
    echo "0 ket qua";
}

mysqli_close($conn);
?>
