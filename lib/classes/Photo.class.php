<?php
class Photo extends WTF {
	
	protected $photo_id;
	protected $urls;
	

	function __construct($photo_id) {
		$this->photo_id = $photo_id;
	}
	
	public static function from_file($file, $title, $description){		
		// save photo to flickr
		require_once __DIR__.'/../phpFlickr-3.1/phpFlickr.php';

		// authenticate to Flickr
		$phpFlickr = new phpFlickr(FLICKR_API_KEY, FLICKR_SECRET);
		$phpFlickr->setToken(CFG_FLICKR_TOKEN);

		// upload the file, return the id for the flickr-hosted photo
		$flickr_photo_id = $phpFlickr->sync_upload($file, $title, $description);

		return new Photo($flickr_photo_id);
	}
	
	/** 
	 * Get the question's id
	 */
	public function getId() {
		return $this->photo_id;
	}
	
	public function getUrls() {
		//if(empty($this->urls)){
			$this->setPhotoUrls();
		//}
		return $this->urls;
	}
	
	// setPhotoUrls asks Flickr for all the avaible sizes and saves them to the object
	function setPhotoUrls() {
		$xml = simplexml_load_string(
			file_get_contents(
				'http://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=' . FLICKR_API_KEY . '&photo_id=' . $this->photo_id
			)
		);
		
		// parse the xml to array for easier handling
		$photo_sizes = Array();
		$i = 0;
    foreach($xml->children() as $sizes){
			foreach($sizes->children() as $size) {
				$photo_sizes[$i]['label'] = (string)$size[0]['label'];
				$photo_sizes[$i]['url'] = (string)$size[0]['source'];
				$i++;
			}
		}
		
		// iterate through all the photo sizes avaible for the current image and saves the urls for each size
		foreach($photo_sizes as $photo_size) {
			if($photo_size['label'] == "Square") {
				$this->urls['thumbnail'] = $photo_size['url'];
			}
			if($photo_size['label'] == "Medium" || $photo_size['label'] == "Small") {
				$this->urls['medium'] = $photo_size['url'];
			}
			if($photo_size['label'] == "Original") {
				$this->urls['original'] = $photo_size['url'];
			}
		}
	}
   
   public function setUrls($thumbnail,$medium,$original){
      $this->urls['thumbnail'] = $thumbnail;
      $this->urls['medium'] = $medium;
      $this->urls['original'] = $original;
   }   

	public function toArray(){
		return parent::toArray();
		
	}
	
}
