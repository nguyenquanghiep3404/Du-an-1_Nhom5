<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php include './views/admin/layout/header.php' ?>
<a href="?act=create-dm"><input type="button" value="Nhập thêm" class="input"></a>
<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Description</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cate as $cates) {?>
        <tr>
            <td><?= $cates['id'] ?></td>
            <td><?= $cates['name'] ?></td>
            <td><?= $cates['description'] ?></td>
            <td><?= $cates['status'] ?></td>
            <td>
               <!-- <a href="?act=delete-dm&id=<?= $cates['id'] ?>" onclick="return confirm('Ban có muốn xoá không?')"><input type="button" value="Xoá"></a> -->
               <a href="?act=update-dm&id=<?= $cates['id'] ?>" ><input type="button" value="Sửa"></a>
               <a href="?act=hide-dm&id=<?= $cates['id'] ?>" onclick="return confirm('Ban có muốn xoá không?')"><input type="button" value="Xoá"></a>
               <a href="?act=show-dm&id=<?= $cates['id'] ?>" onclick="return confirm('Ban có muốn bỏ xoá không?')"><input type="button" value="Bỏ xoá"></a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
   <?php include './views/admin/layout/footer.php' ?>
</body>
</html>

