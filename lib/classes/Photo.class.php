<?php
class Photo {
	
	private $photoId;

	function __construct($photoId) {
		$this->photoId = $photoId;
	}
	
	function getSquareThumbnail() {
		// hämta kvadratisk tumnagel från flickr
	}
	
	function getLargeImage() {
		// hämta stor storlek bild från flickr
	}
	
	function getOriginalImage() {
		// hämta originalstorlek bild från flickr
	}
	
}