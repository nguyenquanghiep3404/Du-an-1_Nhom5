
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">




<form action="?action=registerPost" method="POST">

    <h2 class="text-center mb-4">Đăng Ký</h2>



        <div class="form-group">

            <label for="name">Họ Và Tên</label>

            <input type="text" class="form-control bg-light" id="name" name="name" placeholder="Nhập họ và tên">

        </div>

        <div class="form-group">

            <label for="email">Email</label>

            <input type="email" class="form-control bg-light" id="email" name="email" placeholder="Nhập email">

        </div>

        <div class="form-group">

            <label for="name">Phone</label>

            <input type="text" class="form-control bg-light" id="phone" name="phone" placeholder="phone">

        </div>

        <div class="form-group">

            <label for="name">Địa chỉ</label>

            <input type="text" class="form-control bg-light" id="address" name="address" placeholder="nhập địa chỉ">

        </div>

        <div class="form-group position-relative">

            <label for="password">Mật Khẩu</label>

            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">

            <span class="position-absolute" style="top: 50%; right: 10px;" onclick="togglePasswordVisibility('password', this)">

            </span>

        </div>

        <div class="form-group position-relative">

            <label for="confirm-password">Nhập Lại Mật Khẩu</label>

            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu">

            <span class="position-absolute" style="top: 50%; right: 10px;" onclick="togglePasswordVisibility('confirm-password', this)">

            </span>

        </div>

        <button type="submit" name="btn_dangky" class="btn btn-danger btn-block">Đăng Ký</button>

    <div class="text-center mt-3">

        <p class="mb-1">Bạn đã có tài khoản ? <a href="dang nhap.html" class="text-danger">Đăng Nhập Ngay</a></p>

        <a href="#" class="text-primary">Quên Mật Khẩu</a>

    </div>

</form>
