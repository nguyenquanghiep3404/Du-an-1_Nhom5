<?php 

class cartModels {
    public $conn;
    public function __construct()
    {
        $this->conn = connect_db();
    }

    function subtotal($price, $quantity)
    {
        $subtotal = 0; // Khởi tạo giá trị ban đầu
        $subtotal = (float) $price * (float) $quantity; // Tính tổng giá sản phẩm
        $_SESSION['subtotal'] = $subtotal; // Lưu giá trị tạm vào session
        return $subtotal; // Trả về kết quả
    }
    function temporary()
    {
        $temporary = 0;

        foreach ($_SESSION['myCart'] as $pro => $item) {
            $subtotal = $this->subtotal($item["price"], $item["quantity"]);
            $temporary += $subtotal;
            $_SESSION['myCart'][$pro]['subtotal'] = $subtotal;
        }

        $_SESSION['temporary'] = $temporary;

        return $temporary;
    }
        function total_order()
    {
        $total_order = 0;

        foreach ($_SESSION['myCart'] as $item) {
            $total_order += $item["quantity"];
        }

        $_SESSION['total_order'] = $total_order;
    }
}





?>