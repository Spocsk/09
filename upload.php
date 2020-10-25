<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_FILES)){
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileActualExt,$allowed)){
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNewName = uniqid('',true). "." .$fileActualExt;
                $fileDest = 'search/uploads/'.$fileNewName;
                move_uploaded_file($fileTmpName,$fileDest);
                echo "Sucessfully uploaded";
                

                //add new entry to movies.json files
                $current = file_get_contents("search/src/movies.json");
                $json = json_decode($current,true);
                $new_data = array('id' => uniqid(), 'name' => $_POST["first"], 'descr' => $_POST["middle"], 'thumbnail' => $fileDest, 'category' => []);
                foreach ($_POST as $key => $value) {
                    if ($value == 'on') {
                        array_push($new_data['category'], $key . " ");
                    }
                }
                
                array_push($json,$new_data);
                file_put_contents("search/src/movies.json",json_encode($json));
            }
            else echo "file too big";
        }
        else echo "error from the file";
    }
    else echo "file type not allowed";
}


/* function writeJson($file){

    $current = file_get_contents($file);
    $json = json_decode($current,true);
    $new_data = array('id' => uniqid(), 'name' => $_POST["first"], 'descr' => $_POST["middle"], 'thumbnail' => $fileDest);
    array_push($json,$new_data);
    file_put_contents($file,json_encode($json));
}
 */

?>  

