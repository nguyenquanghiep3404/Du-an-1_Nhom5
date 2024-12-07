<?php
class checkoutModel{
    public $conn;
    public function __construct()
    { 
        $this-> conn = connect_db();  
    }
    
    public function getOrder_details_user_id($user_id)
    {
        $sql = "SELECT * FROM `order_details`  WHERE `order_details` . `user_id` = '$user_id' ORDER BY order_detail_id DESC";
        $data = $this->conn->query($sql);
        return $data->fetch();
    }

    public function getUserName($name)
    {
        $sql = "SELECT * FROM `users` WHERE `users`.`name` = '$name' ";
        $data = $this->conn->query($sql);
        return $data->fetch();
    }

    public function insetOrderDetails($name,$email,$phone,$address,$note,$id,$created_at)
    {   
        $sql = "INSERT INTO `order_details` (`name`, `email`, `phone`, `address`, `note`, `user_id`, `created_at` ) VALUE ('$name', '$email', '$phone', '$address', '$note', '$id', '$created_at')";
        $this->conn->exec($sql);
    }
    
    public function insetOrder($id, $product_id,$order_details_id,$quantity,$price)
    {
        $sql = "INSERT INTO `orders` (`user_id`, `product_id`, `order_detail_id`, `quantity`, `price`) VALUE ('$id', '$product_id', '$order_details_id', '$quantity', '$price') ";
        $this->conn->exec($sql);
    }
    public function processVnpayPayment($orderId, $name, $email, $phone, $address, $note)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/Du-an-1_Nhom5/index.php?action=Vnpay"; // Cập nhật URL trả về
        $vnp_TmnCode = "YOUR_TMN_CODE"; // Mã website VNPAY
        $vnp_HashSecret = "YOUR_HASH_SECRET"; // Chuỗi bí mật

        $vnp_TxnRef = $orderId; // Sử dụng ID đơn hàng làm mã giao dịch
        $vnp_OrderInfo = "Thanh toán đơn hàng #$orderId";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $_POST['amount'] * 100; // Số tiền thanh toán (nhân với 100 để quy đổi thành VND)
        $vnp_Locale = "vn"; // Ngôn ngữ
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        // Sắp xếp mảng đầu vào
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Hash dữ liệu
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng người dùng sang cổng VNPAY
        header('Location: ' . $vnp_Url);
        die();
    }
    
    
    

    public function __destruct()
    {
        $this -> conn = null;
    }
}
?>