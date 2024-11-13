<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Update Category</h1>
    <form action="?act=updatePost-dm&id=<?= $cateEdit['id'] ?>" method="POST">
        <label for="">ID:</label>
        <input type="text" id="id" disabled>
        <label for="">Name:</label>
        <input type="text" id="name" name="name" value="<?= $cateEdit['name'] ?>"required>
        <label for="">Description:</label>
        <input type="text" id="description" name="description" value="<?= $cateEdit['description'] ?>" required>
        <label for="">Status:</label>
        <input type="text" disabled>
        <input type="submit" value="Update">
    </form>
</body>
</html>