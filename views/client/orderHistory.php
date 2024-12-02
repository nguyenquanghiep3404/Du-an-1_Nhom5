<?php include ('./views/client/layout/header.php'); ?>
    <style>
        table {
            width: 100%;
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

<body>
   <?php var_dump($orderHistory) ?>
    <h1>Lịch sử đơn hàng</h1>
    <table>
        <thead>
            <tr>
                <th>ID Đơn hàng</th>
                <th>Tên sản phẩm</th>
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
                    <td><?= htmlspecialchars($order['order_id']) ?></td>
                    <td><?= htmlspecialchars($order['product_id']) ?></td>
                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                    <td><?= number_format($order['price'], 0, ',', '.') ?> VND</td>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                    <td><?= htmlspecialchars($order['email']) ?></td>
                    <td><?= htmlspecialchars($order['phone']) ?></td>
                    <td><?= htmlspecialchars($order['address']) ?></td>
                    <td><?= htmlspecialchars($order['note']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
    
<?php include './views/client/layout/modalPoduct.php' ?>
    <?php include './views/client/layout/miniCart.php' ?>
    <?php include ('./views/client/layout/footer.php'); ?>
