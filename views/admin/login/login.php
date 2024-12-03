<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
        <div class="bg-white p-4 rounded shadow-sm w-100 " style="max-width: 400px;">
   <form action="?action=loginPost" method="POST" style="padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4">Đăng Nhập</h2>
    
            <div class="mb-3">
                <label for="email" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu của bạn">
                    <span class="input-group-text" id="togglePassword"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <button type="submit" name="btn-login" class="btn btn-danger w-100">Đăng Nhập</button>

        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="?action=register" class="text-danger">Đăng Ký Ngay</a></p>
            <a href="?action=client" class="text-danger">Quay về Trang chủ</a>
        </div>
</form>
