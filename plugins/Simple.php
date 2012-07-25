<?php
class Simple implements PluginInterface
{
	function generateImage($canvas)
	{
//		global $captcha_font_path,$captcha_img_path;
	
		$rand = preg_replace("/([0-9])/e","chr((\\1+112))",rand(100000,999999));
		for ($i=0;$i<strlen($rand);$i++)
		{
			$color = imagecolorallocate($canvas, rand(100,255),rand(100,255) , rand(100,255));
			imagefttext($canvas, 20, rand (-45,45), 40+20*$i, 50, $color, $this->ucaptcha->getCaptchaFontPath()."/LiberationMono-Bold.ttf", $rand[$i]);
		}
		$name = $this->ucaptcha->getFilename();
		$path=$this->ucaptcha->getAbsoluteCaptchaImgPath().'/'.$name;
		imagepng($canvas,$path);
		$captcha[0]=$name;
		$captcha[1]=$rand;
		return $captcha;
	}
}
?>
