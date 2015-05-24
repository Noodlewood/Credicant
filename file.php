<?php
if (isset($_FILES["pictures"]) && isset($_POST["title"]))
{
	$target_dir = "productphotos/" . $_POST["title"] ."/";
    mkdir($target_dir);
    foreach($_FILES["pictures"]["name"] as $key => $pictureName) {
        move_uploaded_file($_FILES["pictures"]["tmp_name"][$key], $target_dir.$pictureName);
    }

    header('Location: admin/index.php');
}

if (isset($_POST['action']) && isset($_POST['title'])) {
    if($_POST['action'] == "delete") {
        $target_dir = "productphotos/" . $_POST["title"] ."/";
        deleteDirectory($target_dir);
    }
}

function deleteDirectory($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object !="..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        reset($objects);
        rmdir($dirPath);
    }
}
?>