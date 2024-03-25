<?php
include 'config.php';

// Function to generate a unique Ma_NV
function generateUniqueMaNV($conn) {
    $unique_id = mt_rand(1000, 9999);
    $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$unique_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        return $unique_id;
    } else {
        // If the generated Ma_NV already exists, generate again
        return generateUniqueMaNV($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_nv = $_POST["ten_nv"];
    $phai = $_POST["phai"];
    $noi_sinh = $_POST["noi_sinh"];
    $ma_phong = $_POST["ma_phong"];
    $luong = $_POST["luong"];

    // Generate a unique Ma_NV
    $ma_nv = generateUniqueMaNV($conn);

    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";
    if (mysqli_query($conn, $sql)) {
        echo "Thêm nhân viên thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<h2>Thêm Nhân viên</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Tên Nhân viên: <input type="text" name="ten_nv"><br>
    Giới tính:
    <label><input type="radio" name="phai" value="NAM">Nam</label>
    <label><input type="radio" name="phai" value="NU">Nữ</label><br>
    Nơi Sinh: <input type="text" name="noi_sinh"><br>
    Mã Phòng: 
    <select name="ma_phong">
        <option value="KT">KT</option>
        <option value="TC">TC</option>
        <option value="QT">QT</option>
    </select><br>
    Lương: <input type="text" name="luong"><br>
    <input type="submit" value="Thêm">
</form>
