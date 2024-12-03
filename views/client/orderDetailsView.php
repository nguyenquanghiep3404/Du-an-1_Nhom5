<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
    <h1>Chi tiết đơn hàng</h1>

    <?php if (empty($orderDetails)): ?>
        <p>Không tìm thấy chi tiết đơn hàng.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá đơn hàng</th>
                </tr>
            </thead>
            <?php var_dump($orderDetails) ?>
            <tbody>
                <?php foreach ($orderDetails as $detail): ?>
                    <tr>
                        <td><?= ($detail['name']) ?></td>
                        <td><?= number_format($detail['product_price'], 0, ',', '.') ?> VND</td>
                        <td><?= ($detail['quantity']) ?></td>
                        <td><?= number_format($detail['order_price'], 0, ',', '.') ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="?action=orderHistory">Quay lại lịch sử đơn hàng</a>
</body>
</html>