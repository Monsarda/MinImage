<?php

/**
* 
*/
class Image
{

	private $dir; // Root dir
	public $imgs;
	
	function __construct()
	{}

	public function getSize($filename) 
	{
		$imgsize = getimagesize($filename);

		return array( 'width' => $imgsize[0], 'height' => $imgsize[1] );
	}

	public function search_file($folderName, $blackList = array())
	{

	    $dir = opendir($folderName); 

	    $blackList = array(
	    	'.',
	    	'..',
	    	'.DS_Store',
	    );

	    while (($file = readdir($dir)) !== false)
	    {
	        if(!in_array($file, $blackList))
	        { 
	            if(is_file($folderName."/".$file)) 
	            	$this->imgs[] = $folderName."/".$file;
	            if(is_dir($folderName."/".$file)) 
	            	$this->search_file($folderName."/".$file);
	        } 
	    }

    	closedir($dir);
	}

}

$image = new Image();

$result = $image->search_file('img');
echo "<pre>";
print_r($image->imgs);







