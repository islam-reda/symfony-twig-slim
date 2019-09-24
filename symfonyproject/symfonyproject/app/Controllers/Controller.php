<?php
namespace App\Controllers;
class Controller{
    protected $container;
    protected $view;
    protected $var;

  public function __construct($container){
        $this->container = $container;

      //$session= new \App\Models\session();
      //$session->start();
      if(isset($_SESSION['userEmail']) && !empty($_SESSION['userEmail'])){
          //$_SESSION['userEmail']="";
          $this->container['view']['user'] = $_SESSION['userEmail'];
        }
  }
  public function __get($property){
    if($property == "getview"){
          $property = trim($property,"get");
        if($this->container->{$property}){
          return $this->container->{$property};
        }
      }
      return $this;
  }

    public function moveUploadedFile($files)
    {
        $extension = pathinfo($files["name"], PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        //$files  =     $_FILES["ad_img1"]

        $target_dir = realpath($_SERVER['DOCUMENT_ROOT']).DIRECTORY_SEPARATOR.'uploads/';
        $target_file = $target_dir . basename($filename);
        //echo $target_file;
        //die;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($files["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($files["size"] > 900000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($files["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["ad_img1"]["name"]). " has been uploaded.";
                //echo "uploads".DIRECTORY_SEPARATOR.$_FILES["ad_img1"]["name"];
                //echo "<br />";
                //return "//" . $_SERVER['SERVER_NAME'];

                //die();

                return "//" . $_SERVER['SERVER_NAME'].DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$filename;

            } else {
                //echo "Sorry, there was an error uploading your file.";
                return 0;

            }
        }


    }
}
