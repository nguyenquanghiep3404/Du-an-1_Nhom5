<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
        <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 400px;">
<form action="index.php?action=login" method="POST">
        <h2 class="text-center mb-4">Đăng Nhập</h2>
    
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn">
                    <span class="input-group-text" id="togglePassword"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <button type="submit" name="btn_dangnhap" class="btn btn-danger w-100">Đăng Nhập</button>

        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="#" class="text-danger">Đăng Ký Ngay</a></p>
            <a href="#" class="text-danger">Quên Mật Khẩu</a>
        </div>
</form>
</body>
</html>