<?php
include 'config.php';

// Function to get employee details by ID
function getEmployeeDetails($conn, $id) {
    $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $ten_nv = $_POST["ten_nv"];
    $phai = $_POST["phai"];
    $noi_sinh = $_POST["noi_sinh"];
    $ma_phong = $_POST["ma_phong"];
    $luong = $_POST["luong"];

    $sql = "UPDATE nhanvien SET Ten_NV = '$ten_nv', Phai = '$phai', Noi_Sinh = '$noi_sinh', Ma_Phong = '$ma_phong', Luong = '$luong' WHERE Ma_NV = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật thông tin nhân viên thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Check if ID parameter is passed in URL
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $employee = getEmployeeDetails($conn, $id);
}
else {
    echo "Invalid Employee ID";
    exit;
}

mysqli_close($conn);
?>

<h2>Sửa Nhân viên</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Tên Nhân viên: <input type="text" name="ten_nv" value="<?php echo $employee['Ten_NV']; ?>"><br>
    Giới tính:
    <label><input type="radio" name="phai" value="NAM" <?php if($employee['Phai'] == 'NAM') echo 'checked'; ?>>Nam</label>
    <label><input type="radio" name="phai" value="NU" <?php if($employee['Phai'] == 'NU') echo 'checked'; ?>>Nữ</label><br>
    Nơi Sinh: <input type="text" name="noi_sinh" value="<?php echo $employee['Noi_Sinh']; ?>"><br>
    Mã Phòng: 
    <select name="ma_phong">
        <option value="KT" <?php if($employee['Ma_Phong'] == 'KT') echo 'selected'; ?>>KT</option>
        <option value="TC" <?php if($employee['Ma_Phong'] == 'TC') echo 'selected'; ?>>TC</option>
        <option value="QT" <?php if($employee['Ma_Phong'] == 'QT') echo 'selected'; ?>>QT</option>
    </select><br>
    Lương: <input type="text" name="luong" value="<?php echo $employee['Luong']; ?>"><br>
    <input type="submit" value="Cập nhật">
</form>
