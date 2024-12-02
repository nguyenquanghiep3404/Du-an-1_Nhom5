<?php include ('./views/client/layout/header.php'); ?>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>

<div>
   <!-- <?php var_dump($orderHistory) ?> -->
    <h2 class="text-center mt-4 mb-4">Lịch sử đơn hàng</h>
    <table class="mt-3" style="margin-left:25px;margin-right:15px;">
        <thead>
            <tr>
                <th>ID Đơn hàng</th>
                <th>Mã sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tên người nhận</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                 <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderHistory as $order): ?>
                <tr>
                    <td><?= ($order['order_id']) ?></td>
                    <td><?= ($order['product_id']) ?></td>
                    <td><?= ($order['quantity']) ?></td>
                    <td><?= number_format($order['price'], 0, ',', '.') ?> VND</td>
                    <td><?= ($order['name']) ?></td>
                    <td><?= ($order['email']) ?></td>
                    <td><?= ($order['phone']) ?></td>
                    <td><?= ($order['address']) ?></td>
                    <td><?= ($order['note']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    
<?php include './views/client/layout/modalPoduct.php' ?>
    <?php include './views/client/layout/miniCart.php' ?>
    <?php include ('./views/client/layout/footer.php'); ?>
