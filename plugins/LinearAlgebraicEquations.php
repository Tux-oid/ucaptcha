<?php
class LinearAlgebraicEquations implements PluginInterface
{

	function generateImage($canvas)
	{
		$rand = "X+";
		$a1=rand(0,10);
		$a2=rand(-10,15);
		$rand.=$a1."=".$a2;
		$ans=$a2-$a1;
		for ($i=0;$i<strlen($rand);$i++)
		{
			$color = imagecolorallocate($canvas, rand(100,255),rand(100,255) , rand(100,255));
			imagefttext($canvas, 20, rand (-20,20), 40+20*$i, 50, $color, $this->ucaptcha->getCaptchaFontPath()."/LiberationMono-Bold.ttf", $rand[$i]);
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
