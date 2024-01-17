<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <Main>
        <h2>Image Upload</h2>

        <form action="upload_handle.php" method="post" enctype="multipart/form-data">
            <label for="image">Choose an image:</label>
            <input type="file" name="image" accept="image/*">
            <input type="submit" value="Upload Image">
        </form>
    </Main>
</body>