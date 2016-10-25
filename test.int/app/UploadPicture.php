<?php

namespace App;



use Intervention\Image\ImageManagerStatic as Image;


class uploadPicture
{

        private $originalHeight = "";
        private $originalWidth = "";
        private $newSmallHeight = "";
        private  $newSmallWidth = "";

        private $newMediumHeight = "";
        private  $newMediumWidth = "";

        private $file;
        private $name;


    public function __construct($initFile, $initName)
    {
        $this->file = $initFile;
        $this->name = $initName;

    }

    public function store()
    {

        $size = getimagesize($this->file);
        $oldHeight = $size{1};
        $oldWidth = $size{0};

        $originalHeight = $oldHeight;
        $originalWidth = $oldWidth;

        if ($oldHeight > $oldWidth) {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = $oldWidth / $oldHeight * 108;

            $this->newMediumHeight = 216;
            $this->newMediumWidth = $oldWidth / $oldHeight * 216;

        } elseif ($oldWidth > $oldHeight) {
            $this->newSmallWidth = 162;
            $this->newSmallHeight = $oldHeight / $oldWidth * 162;

            $this->newMediumWidth = 384;
            $this->newMediumHeight = $oldHeight / $oldWidth * 384;

        } else {
            $this->newSmallHeight = 108;
            $this->newSmallWidth = $oldWidth / $oldHeight * 108;

            $this->newMediumHeight = 216;
            $this->newMediumWidth = $oldWidth / $oldHeight * 216;

        }



        $imgSmal = Image::make($this->file)->resize($this->newSmallWidth, $this->newSmallHeight)->save('images/small/' . $this->name . ".jpg");
        $imgMedium = Image::make($this->file)->resize($this->newMediumWidth, $this->newMediumHeight)->save('images/medium/' .  $this->name . ".jpg");
        $imgBig = Image::make($this->file)->resize($this->originalWidth, $this->originalHeight)->save('images/big/' .  $this->name . ".jpg");



    }

}