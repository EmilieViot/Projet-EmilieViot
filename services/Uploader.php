<?php

class Uploader {

    private array $extensions = ["jpeg","jpg","png", "pdf"];
    private string $uploadFolder = "uploads";
    private string $picturesFolder = "assets/img";
    private RandomStringGenerator $gen;

    public function __construct()
    {
        $this->gen = new RandomStringGenerator();
    }

    /**
     * @param array $files your $_FILES superglobal
     * @param string $uploadField the name of the type="file" input
     *
     */
    public function upload(array $files, string $uploadField) : ?Picture
    {
        if(isset($files[$uploadField])){
            try {
                $file_name = $files[$uploadField]['name'];
                $file_tmp =$files[$uploadField]['tmp_name'];

                $tabFileName = explode('.',$file_name);
                $file_ext=strtolower(end($tabFileName));

                $newFileName = $this->gen->generate(8);

                if(in_array($file_ext, $this->extensions) === false){
                    throw new Exception("Bad file extension. Please upload a JPG, PDF or PNG file.");
                }
                else
                {
                    $url = $this->uploadFolder."/".$newFileName.".".$file_ext;
                    move_uploaded_file($file_tmp, $url);
                    return new Picture($url, $file_name);
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                return null;
            }

        }

        return null;
    }

    public function uploadPictures(array $files, string $uploadField) : ?Picture
    {
        if(isset($files[$uploadField])){
            try {
                $file_name = $files[$uploadField]['name'];
                $file_tmp =$files[$uploadField]['tmp_name'];

                $tabFileName = explode('.',$file_name);
                $file_ext=strtolower(end($tabFileName));

                $newFileName = $this->gen->generate(8);

                if(in_array($file_ext, $this->extensions) === false){
                    throw new Exception("Bad file extension. Please upload a JPG, PDF or PNG file.");
                }
                else
                {
                    $url = $this->picturesFolder."/".$newFileName.".".$file_ext;
                    move_uploaded_file($file_tmp, $url);
                    return new Picture($url, $file_name);
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                return null;
            }

        }

        return null;
    }
}