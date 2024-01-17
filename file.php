<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Pictures</title>
</head>
<body>
    <h1>Upload Pictures</h1>
    <input type="file" id="imageInput" accept="image/*">
    <button onclick="uploadImage()">Upload</button>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"])) {
        $uploadDirectory = "Jessie/";

        $fileName = $_FILES["image"]["name"];
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileType = exif_imagetype($fileTmpName);
        $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);

        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid image format. Only JPEG, PNG, and GIF are allowed.";
            exit();
        }

        $destination = $uploadDirectory . $fileName;
        if (move_uploaded_file($fileTmpName, $destination)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file selected.";
    }
}
?>

</body>
</html>
