<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>New Category</h1>
    <form action="?act=createPost-dm" method="POST">
        <label for="">ID:</label>
        <input type="text" id="id" disabled>
        <label for="">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="">Description:</label>
        <input type="text" id="description" name="description" required>
        <label for="">Status:</label>
        <input type="text" disabled>
        <input type="submit" value="New">
    </form>
</body>
</html>