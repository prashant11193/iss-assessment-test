<?php

//create two separate methods called "contain" and "cover" that will calculate the new width and height of imageB based on the contain and cover strategies.

interface ImageInterface {
    //return the width and height properties
    public function getWidth();
    public function getHeight();
}

class Image implements ImageInterface {
    private $width; //make the properties private to prevent external access.
    private $height; //make the properties private to prevent external access.

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    /*
     calculate the aspect ratio of both images(A&B) and determine which dimension (width or height) of imageB needs to be scaled down in order to fit fully within imageA while maintaining the aspect ratio of image.
    */
    public function contain(Image $image) {
        $imageARatio = $this->getWidth() / $this->getHeight();
        $imageBRatio = $image->getWidth() / $image->getHeight();
        if ($imageARatio > $imageBRatio) {
            $newHeight = $this->getHeight();
            $newWidth = $image->getWidth() * ($newHeight / $image->getHeight());
        } else {
            $newWidth = $this->getWidth();
            $newHeight = $image->getHeight() * ($newWidth / $image->getWidth());
        }
        return new Image($newWidth, $newHeight);
    }

    /*
    calculate the aspect ratio of both images(A&B) and determine which dimension (width or height) of imageB needs to be scaled up in order to cover as much of imageA as possible while maintaining the aspect ratio.
    */
    public function cover(Image $image) {
        $imageARatio = $this->getWidth() / $this->getHeight();
        $imageBRatio = $image->getWidth() / $image->getHeight();
        if ($imageARatio < $imageBRatio) {
            $newHeight = $this->getHeight();
            $newWidth = $image->getWidth() * ($newHeight / $image->getHeight());
        } else {
            $newWidth = $this->getWidth();
            $newHeight = $image->getHeight() * ($newWidth / $image->getWidth());
        }
        return new Image($newWidth, $newHeight);
    }
}

// defining the input sample for both the images.
$imageAInput = ['width' => 250, 'height' => 500];
$imageBInput = ['width' => 500, 'height' => 90];

$imageA = new Image($imageAInput['width'], $imageAInput['height']);
$imageB = new Image($imageBInput['width'], $imageBInput['height']);

//get the new dimension for imageB via contain strategy.
$newImageB = $imageA->contain($imageB);
echo "Contain: ImageB Width: " . $newImageB->getWidth() . " ImageB Height: " . $newImageB->getHeight();
//get the new dimension for imageB via cover strategy.
$newImageB = $imageA->cover($imageB);
echo "Cover: ImageB Width: " . $newImageB->getWidth() . " ImageB Height: " . $newImageB->getHeight();

?>