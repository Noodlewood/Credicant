<?php
if (isset($_POST["title"]))
{
    $_POST["title"] = preg_replace('/\s+/', '', $_POST["title"]);

	$target_dir = "productphotos/" . $_POST["title"] ."/";

    if(!file_exists($target_dir))   mkdir($target_dir);

    foreach($_FILES["pictures"]["name"] as $key => $pictureName) {
        $pictureName = preg_replace('/\s+/', '', $pictureName);

        move_uploaded_file($_FILES["pictures"]["tmp_name"][$key], $target_dir.$pictureName);
    }

    header('Location: admin/index.php');
}

if (isset($_POST['action']) && isset($_POST['title'])) {
    $_POST["title"] = preg_replace('/\s+/', '', $_POST["title"]);

    if($_POST['action'] == "delete") {
        $target_dir = "productphotos/" . $_POST["title"] ."/";
        deleteDirectory($target_dir);
    }
    if($_POST['action'] == "deletePhotos") {
        $target_dir = "productphotos/" . $_POST["title"] ."/";
        deleteDirectory($target_dir);
    }
}

if (isset($_POST['action'])) {
    if($_POST['action'] == "deletePhotos") {
        $target_dir = "productphotos/";
        deletePhotos($target_dir);
        mkdir($target_dir);
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


function deletePhotos($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir")
                    deletePhotos($dir."/".$object);
                else unlink ($dir."/".$object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
?>