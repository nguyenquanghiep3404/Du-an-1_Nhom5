<?php
class categoryControllers{
    public $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new categoryModel();
    }
// Lấy danh sách danh mục
    public function all_dm()
    {
        $cate = $this->categoryModel->all_dm();
        require_once "./views/admin/show-dm.php";
    }
    // Ẩn danh mục 
    public function hide_dm() 
    { 
        $id = $_GET['id']; $this->categoryModel->hide_dm($id); 
        header('location:?act=home-dm'); 
    } 
    // Hiển thị lại danh mục 
    public function show_dm() 
    { 
        $id = $_GET['id']; $this->categoryModel->show_dm($id); 
        header('location:?act=home-dm'); 
    }

// Xoá 
    // public function delete_dm()
    // {
    //     $id = $_GET['id'];
    //     $this->categoryModel->delete_dm($id);
    //     header('location:?act=home-dm');
    // }


// Thêm
    public function create_dm()
    {
        require_once './views/admin/formCategory.php';
    }
    public function createPost_dm()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $this->categoryModel->inset_dm($name,$description);
        header('location:?act=home-dm');
    }
// Sửa
    public function update_dm()
    {
        $id = $_GET['id'];
        $cateEdit = $this->categoryModel->find_dm($id);
        require_once './views/admin/updateCategory.php';
    }
    public function updatePost_dm()
    {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $this->categoryModel->update_dm($id,$name,$description);
        header('location:?act=home-dm');
    }
}
?>