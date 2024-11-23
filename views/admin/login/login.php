
        <div class="bg-white p-4 rounded shadow-sm w-100 " style="max-width: 400px;">
   <form action="?action=loginPost" method="POST">
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
            <p>Bạn chưa có tài khoản? <a href="#" class="text-danger">Đăng Ký Ngay</a></p>
            <a href="#" class="text-danger">Quên Mật Khẩu</a>
        </div>
</form>
