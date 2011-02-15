<?php
class Photo extends WTF {
	
	protected $photo_id;
	protected $thumbnail_url;
	protected $medium_url;
	protected $original_url;
	

	function __construct($photo_id) {
		$this->photo_id = $photo_id;
		$this->setPhotoUrls();
	}
	
	/** 
	 * Get the question's id
	 */
	public function getId() {
		return $this->id;
	}
	
	// setPhotoUrls asks Flickr one time for all the avaible sizes and saves them to the object
	function setPhotoUrls() {
		$xml = simplexml_load_string(
			file_get_contents(
				'http://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=' . FLICKR_API_KEY . '&photo_id=' . $this->photo_id
			)
		);
		$photo_sizes = $this->flickrImageSizeXML2Array($xml);
		
		// iterate through all the photo sizes avaible for the current image and saves the urls for each size
		foreach($photo_sizes as $photo_size) {
			if($photo_size['label'] == "Square") {
				$this->thumbnail_url = $photo_size['url'];
			}
			if($photo_size['label'] == "Medium") {
				$this->medium_url = $photo_size['url'];
			}
			if($photo_size['label'] == "Original") {
				$this->original_url = $photo_size['url'];
			}
		}
	}
	
}