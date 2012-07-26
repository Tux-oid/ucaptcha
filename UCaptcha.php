<?php

require_once "PluginInterface.php";
require_once "plugs.dcfg.php";

class UCaptcha
{
	protected $captchaPlugunPath;
	protected $captchaFontPath;
	protected $captchaImgPath;
	protected $captchaTplPath;
	protected $uCaptchaPlugins;

	public function __construct($captchaPlugunPath = "/plugins", $captchaFontPath = "/fonts", $captchaImgPath = "/cpt", $captchaTplPath = "/images")
	{
		global $uCaptchaPlugins;
		$this->uCaptchaPlugins = $uCaptchaPlugins;
		$this->captchaPlugunPath = $captchaPlugunPath;
		$this->captchaFontPath = $captchaFontPath;
		$this->captchaImgPath = $captchaImgPath;
		$this->captchaTplPath = $captchaTplPath;
	}

	public function draw($level = 0)
	{
		if(count($this->uCaptchaPlugins[$level]) == 0)
		{
			$image = NULL;
		}
		else
		{
			if(!in_array($level, $this->getPluginsLevels()))
				throw new \Exception('Level is invalid');
			$captcha = $this->generateImage($level);
			$_SESSION['captchaKeyString'] = $captcha[1];
			$image = $this->getCaptchaImgPath().'/'.$captcha[0];
			$_SESSION['captchaImage'] = $captcha[1];//FIXME:save information about image, keystring and date to file
		}
		return $image;
	}

	protected function generateImage($level)
	{
		$pl = rand(0, count($this->uCaptchaPlugins[$level]) - 1);
		require_once $this->getAbsoluteCaptchaPlugunPath()."/" . $this->uCaptchaPlugins[$level][$pl] . ".php";
		$generator = new $this->uCaptchaPlugins[$level][$pl];
		$generator->ucaptcha = $this;
		$canvas = $this->prepareCanvas();
		$captcha = $generator->generateImage($canvas);
		return $captcha;
	}

	public function check($val)
	{
		if(!isset($_SESSION['captchaKeyString']))
		{
			return false;
		}
		$answer = $_SESSION['captchaKeyString'];
		/* Check captcha type */
		$type = gettype($answer);
		switch($type)
		{
			case 'integer':
			case 'double':
				if(!is_numeric($val))
				{
					return false;
				}
		}
		unlink($this->getAbsoluteCaptchaImgPath().'/'.$_SESSION['captchaImage']);//FIXME:remove files with creation date more than 5 hours ago
		return ($val == $answer);
	}

	public function reset()
	{
		$_SESSION['captchaKeyString'] = NULL;
		unlink($this->getAbsoluteCaptchaImgPath().'/'.$_SESSION['captchaImage']);
		$_SESSION['captchaImage'] = NULL;
	}

	protected function dbStoreAnswer($uuid, $answer)
	{
		return 0;
	}

	protected function dbGetAnswer($uuid)
	{
		return 0;
	}

	protected function prepareCanvas()
	{
		$this->captchaTplPath;
		$canvas = imagecreatefrompng($this->getAbsoluteCaptchaTplPath() . "/template.png");
		return $canvas;
	}

	public function getFilename()
	{
		return md5(microtime() + rand(0, 255)).'.png';
	}

	public function getPluginsLevelsCount()
	{
		return count($this->uCaptchaPlugins);
	}

	public function getPluginsLevels()
	{
		$ret = array();
		foreach($this->uCaptchaPlugins as $key => $value)
		{
			$ret[] = $key;
		}
		return $ret;
	}

	public function setCaptchaFontPath($captchaFontPath)
	{
		$this->captchaFontPath = $captchaFontPath;
	}

	public function getCaptchaFontPath()
	{
		return $this->captchaFontPath;
	}

	public function getAbsoluteCaptchaFontPath()
	{
		return __DIR__.$this->captchaFontPath;
	}

	public function setCaptchaImgPath($captchaImgPath)
	{
		$this->captchaImgPath = $captchaImgPath;
	}

	public function getCaptchaImgPath()
	{
		return $this->captchaImgPath;
	}

	public function getAbsoluteCaptchaImgPath()
	{
		return __DIR__.$this->captchaImgPath;
	}

	public function setCaptchaPlugunPath($captchaPlugunPath)
	{
		$this->captchaPlugunPath = $captchaPlugunPath;
	}

	public function getCaptchaPlugunPath()
	{
		return $this->captchaPlugunPath;
	}

	public function getAbsoluteCaptchaPlugunPath()
	{
		return __DIR__.$this->captchaPlugunPath;
	}

	public function setCaptchaTplPath($captchaTplPath)
	{
		$this->captchaTplPath = $captchaTplPath;
	}

	public function getCaptchaTplPath()
	{
		return $this->captchaTplPath;
	}

	public function getAbsoluteCaptchaTplPath()
	{
		return __DIR__.$this->captchaTplPath;
	}

}
?>
