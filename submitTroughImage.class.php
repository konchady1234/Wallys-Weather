<?php


class submitTroughImage {

	//set defaults
	var $_rotate				= 39;				//set max rotation
	var $_fontsize				= 12;				//set default font size
	var $_amount 				= 4;				//default amount of chars to generate
	var $_STIkeyName			= 'STI_key'; 		//default name of hidden form MD5 key
	var $_STIimgString 			= 'STI_imgString';  //default name of image string form input
	var $_backgroundColor 		= '205,205,205';    //default background color
	var $_backgroundTransparent	= true;				//transparent and anti alias to background color?
	var $_stringType			= 'char';		//int generate only numbers.

    //declare globals
    var $_string = "";
    var $_error = array();
    var $_fonts = array();
    var $_colors = array();
	var $_backend = false;


	/**
	* VOID submitTroughImage(VOID)
	*	Constructor
	*/
	function submitTroughImage(){
    	//start session?
    	if(!session_id())
    		@session_start(); //without errors...

		//check if we have a session now!
		if(session_id())
			$this->_backend = true;
	}


	/**
	* [STRING $error] = error([STRING $error])
	*	Set and/or get errors.
	*/
	function error($error = ""){
		if($error)
			$this->_error[] = $error;
		return implode("<br>",$this->_error);
	}


    /**
    * BOOL $match = checkPost(VOID)
    *	Check if the posted STI form fields matched.
    */
    function checkPost(){
    	//Get the MD5 key and do the match
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//check witch backend
			if($this->_backend === true){
				//do it with the session backend...
				if($_SESSION[$this->_STIkeyName] == md5(strtoupper($_REQUEST[$this->_STIimgString])))
					return true;
			}else{
				//with hardisk backend
				if($_REQUEST[$this->_STIkeyName] == md5(strtoupper($_REQUEST[$this->_STIimgString])) && file_exists($this->_backend."/".$_REQUEST[$this->_STIkeyName])){
					//remove image...
					unlink($this->_backend."/".$_REQUEST[$this->_STIkeyName]);
					return true;
				}
				//try to remove... supress errors, file may be not there because we have a lame hacker...
				@unlink($this->_backend."/".$_REQUEST[$this->_STIkeyName]);
			}
			return false;
		}
		return null;
    }


    /**
    * STRING $hiddenFormInput = parseKeyInput(VOID)
    *	Parse complete hidden form input with md5 key.
    */
    function parseKeyInput(){
    	return "<input type=\"hidden\" name=\"{$this->_STIkeyName}\" value=\"".$this->getKey()."\">";
    }


    /**
    * STRING $stringFormInput = parseStringInput(VOID)
    *	Parse complete form input for string input.
    */
    function parseStringInput(){
    	return "<input type=\"text\" name=\"{$this->_STIimgString}\" value=\"\" size=\"".($this->getCharAmount() + 1)."\" maxlength=\"".$this->getCharAmount()."\">";
    }


    /**
    * VOID setStringType(STRING $type)
    *	Alowed types:
    *		'int' 		= only numbers
    *		'char' 		= only chars
    *		'varchar'	= both numbers and chars
	*/
	function setStringType($type){
		$a = array('int','char','varchar');
    	if(in_array($type,$a))
    		$this->_stringType = $type;
    	else
    		$this->error("String type '$type' not alowed, only these: ".implode(", ",$a));
	}


	/**
	* [ARRAY $fonts] = setFont([STRING $path])
	*	Set and get path to font or fonts.
	*/
	function setFont($path = ""){
		if(file_exists(realpath($path)))
			$this->_fonts[] = realpath($path);
		else
			$this->error("Couldn't find path to font: $path");
		return $this->_fonts;
	}


	/**
	* [ARRAY $fonts] = getFonts(VOID)
	*	Get all path's to font or fonts.
	*/
    function getFonts(){
		return $this->_fonts;
    }


	/**
	* [ARRAY $colors] = setColor([STRING $color])
	*	Set and get colors. Input can be HEX or a comma seperated rgb value
	*/
	function setColor($color){
		if($color)
			$this->_colors[] = $color;
		return $this->_colors;
	}


	/**
	* [ARRAY $colors] = getColors(VOID)
	*	Get all colors as an array.
	*/
    function getColors(){
		return $this->_colors;
    }


	/**
	* VOID setCharAmount(INT $amount)
	*	Set amount of chars in the image.
	*/
	function setCharAmount($am){
		$this->_amount = $am;
	}


	/**
	* INT $amount = getCharAmount(VOID)
	*	Get amount of chars in the image.
	*/
	function getCharAmount(){
		return $this->_amount;
	}


	/**
	* VOID setBackgroundColor(STRING $color)
	*	Set background color. Input can be HEX or a comma seperated rgb value.
	*	This will be over ruled by setBackgroundImage()
	*/
	function setBackgroundColor($color){
    	$this->_backgroundColor = $color;
	}


	/**
	* VOID setBackgroundTransparent(BOOL $trans)
	*	Set transparent background color. (anti aliased)
	*	This will be over ruled by setBackgroundImage()
	*/
	function setBackgroundTransparent($trans){
    	$this->_backgroundTransparent = $trans;
	}


	/**
	* VOID setBackgroundImage(STRING $path)
	*	Set the path to the background image.
	*/
	function setBackgroundImage($path){
		$path = realpath($path);
		if(file_exists($path)){
			list($w,$h,$t) = getimagesize($path);
			switch($t){
            	case 1: $type = 'gif'; break;
            	case 2: $type = 'jpeg'; break;
            	case 3: $type = 'png'; break;
			}
			if($t > 0 && $t < 4){
				$this->_template = array(
										'path' => $path,
										'width' => $w,
										'height' => $h,
										'type' => $type,
										't' => $t
									);
			}else{
				$this->error("Wrong type '$type'. Could not use background: $path");
        	}
		}else{
			$this->error("Could not find background image: $path");
		}
	}


	/**
	* VOID setRotation(INT $rotate)
	*	Set maximum rotation of every char.
	*/
	function setRotation($rotate){
    	if(is_int($rotate) && $rotate >= 0 && $rotate <=360)
    		$this->_rotate = $rotate;
    	else
    		$this->error("Rotation is not between 0 an 360. Fall back on default.");
	}


	/**
	* STRING $string = randomString(INT $length)
	*	Create a random string.
	*/
	function randomString($len){
		//no need for this line after php 4.2.0
		srand((float)microtime() * 1000000);
        if($this->_stringType == 'int'){
			$str = rand();
			while(strlen($str) < $len)
				$str.= $this->randomString($len);
        }elseif($this->_stringType == 'char'){
			for($i=0;$i<$len;$i++)
				$str.= chr(rand(0,25)+65);
		}elseif($this->_stringType == 'varchar'){
			for($i=0;$i<$len;$i++){
				$c = rand(0,25)+65;
				$str.= chr($c);
			}
        }
    	return substr($str,0,$len);
	}


	/**
	* STRING $key = getKey(VOID)
	*	Get the md5 key of the generated string.
	*/
    function getKey(){
		if(!$this->_string)
			$this->_string = $this->randomString($this->getCharAmount());

		return md5($this->_string);
    }


	/**
	* [BOOL worked =] setBackendPath(STRING $path)
	*	Set the path to the directory where the images are stored.
	*	To have better security, use a path outside the webserver root.
	*	This function is for better security and required when you don't
	*	use sessions.
	*/
	function setBackendPath($path){
		$p = realpath($path);
		if(file_exists($path)){
			//check if we can write to the backend...
            $t = $p."/".uniqid('test');
			if(@touch($t)){
				unlink($t);
				$this->_backend = $p;

                $this->cleanBackendDir();

				return true;
			}else{
				$this->error("The backend path is not writable for the webserver: $p");
			}
		}else{
			$this->error("Could not find the backend path to the image dir: $path");
		}
		$this->error("You do see an image?? You're using the default session backend!");
	}


    /**
    * VOID cleanBackendDir(VOID)
    *	This method cleans all old key files older than 10 minutes...
    */
 	function cleanBackendDir(){
		$p = realpath($this->_backend);
		if(file_exists($p) && $d = opendir($p)){
			while (false !== ($file = readdir($d))) {
            	if(substr($file,0,1) != "." && strlen($file) == 32 && (time() - filemtime("$p/$file") > (60 * 10))){
            		unlink("$p/$file");
            	}
        	}
		}
 	}


	/**
	* VOID createImage([INT $w] [,INT $h])
	*	Create image.
	*/
	function createImage($w=0,$h=0){
    	//check for backend
    	if($this->_backend === false){
    		$this->error("Image couldn't be created. Backend is not set, start session or use setBackendPath(STRING \$path).");
    	}else{
        	//we have a backend!
			$charWidth = array();

			//no need for this line after php 4.2.0
			srand((float)microtime() * 1000000);

			//build random string?
			if(!$this->_string)
				$this->_string = $this->randomString($this->getCharAmount());

			//build and randomize colors for every char
			if(!count($this->getColors()))
				$this->setColor('0,0,0');
			$colors = array();
			while(count($colors) < $this->getCharAmount())
				$colors = array_merge($colors,$this->getColors());
			shuffle($colors);

			//build and randomize all fonts ;) just to nagg ocr lamers ;)
			if(!count($this->getFonts())){
				$this->error("There are no fonts defined!!");
			}else{
				$fonts = array();
				while(count($fonts) < $this->getCharAmount())
					$fonts = array_merge($fonts,$this->getFonts());
				shuffle($fonts);

				//build random rotation
				while(count($rotate) < $this->getCharAmount()){
					for($i=0;$i<$this->_rotate;$i=$i+5){
						$rotate[] = $i;
						$rotate[] = $i * -1; //make negative also
					}
				}
				shuffle($rotate);

				//messure start size.
				$width = $height = 0;
				for($i=0;$i<strlen($this->_string);$i++){
					$size = imagettfbbox($this->_fontsize, $rotate[$i], $fonts[$i], $this->_string{$i});

					$bw = abs($size[2] - $size[0]);
   					$bh = abs($size[5] - $size[3]);

                    $bw+= ($bw / 100) * 30; //add margin

                    $width+= $charWidth[$i] = $bw;
                	if($bh > $height)
                		$height = $bh;
				}

				//calc margin
				$margin = ($height / 100) * 30;
                $height = $height + $margin;

				//build new canvas
				if(is_array($this->_template) && $this->_template['width']){
					//use backround as template
					eval('$temp = imagecreatefrom'.$this->_template['type'].'($this->_template[\'path\']);');
					if(!$w && !$h){
						//use background as canvas
						$w = $this->_template['width'];
						$h = $this->_template['height'];
						$image = $temp;
					}else{
						//scale background...
						$scale = ($h >= $w) ? $h / $this->_template['height'] : $w / $this->_template['width'];
						$image = imagecreatetruecolor($w, $h);
						imagecopyresampled($image, $temp, 0, 0, 0, 0, $w, $h, $this->_template['width'], $this->_template['height']);
					}
				}else{
					//use messured size...
					if(!$w && !$h){
						$w = $width;
						$h = $height;
					}
					//create empty canvas
					$image = imagecreate($w, $h);
					list($r,$g,$b) = strpos($this->_backgroundColor,',')>0 ? explode(',',$this->_backgroundColor) : $this->hex2rgb($this->_backgroundColor);
					$back = imagecolorallocate($image, $r, $g, $b);
					if($this->_backgroundTransparent === true)
						imagecolortransparent($image,$back);
				}

				//calc font size so it fits ;)
				$scale = ($h >= $w) ? $height / $h : $width / $w;
				$fontsize = round($this->_fontsize / $scale);

				//add string to the image
				$nextLeft = round((($charWidth[0] / 100) * 15) / $scale);
				for($i=0;$i<strlen($this->_string);$i++){
					//get color
					list($r,$g,$b) = strpos($colors[$i],',')>0 ? explode(',',$colors[$i]) : $this->hex2rgb($colors[$i]);
					$color = imagecolorallocate($image, $r, $g, $b);

					//add text..
					imagettftext($image, $fontsize, $rotate[$i], $nextLeft, $h - round($margin / $scale), $color, $fonts[$i], $this->_string{$i});

					//calc next position...
					$nextLeft+= round($charWidth[$i] / $scale);
				}

				//get the image code...
				if($this->_backend === true){
					//push to session
					ob_start();
					imagepng($image);
					$_SESSION['STI_imageSource'] = ob_get_contents();
					$_SESSION[$this->_STIkeyName] = $this->getKey();
					ob_clean();
				}elseif($this->_backend !== false){
					//write to disk
					imagepng($image,$this->_backend."/".$this->getKey());
				}

				//cleanup
				if($temp)
					imageDestroy($temp);
				imageDestroy($image);
			}
		}
	}


	/**
	* VOID parseImage([STRING $key])
	*	Parse created image. $key is the md5 key of the generated string
	*	passed by
	*/
	function parseImage($key=''){
        if($this->_backend === false){
        	$this->error("No backend configured, could not parse image...");
        }else{
			header("Content-Type: image/jpeg");

			if($this->_backend === true){
				if($_SESSION['STI_imageSource'])
					echo $_SESSION['STI_imageSource'];
 		        else
		        	$this->error("Couldn't find generated image in session.");

			}elseif($this->_backend !== false){
				$path = $this->_backend."/".$key;
				if(file_exists($path)){
					$fp = fopen($path, 'rb');
					header("Content-Length: ".filesize($path));
					fpassthru($fp);
				}else{
		        	$this->error("Couldn't find generated image: $path/$key");
				}
			}
			exit;
		}
	}


	/**
	* ARRAY $rgb = hex2rgb(STRING $hex);
	*	Make a rgb array from html hex color value...
	*/
	function hex2rgb($hex){
		$color = str_replace('#','',$hex);
		return array(
					hexdec(substr($color,0,2)),
					hexdec(substr($color,2,2)),
					hexdec(substr($color,4,2))
					);
	}


}
?>