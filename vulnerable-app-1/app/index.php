<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>1. Chọn file mã nguồn:</label><br>
    <input type="file" name="file" required><br><br>
    
    <label>2. Tên file lưu trên server (Nhập Payload vào đây):</label><br>
    <input type="text" name="filename" value="hacked.php" size="40"><br><br>
    
    <input type="submit" value="Upload">
</form>