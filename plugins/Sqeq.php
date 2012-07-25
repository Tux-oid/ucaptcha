<?php
class Sqeq implements PluginInterface
{
	function generateImage($canvas)
	{
		$a=1;$b=1;$c=100;
		while (($b^2)-(4*$a*$c)<0)
		{
			$a=rand(-5,10);
			$b=rand(-5,10);
			$c=rand(-5,10);
		}
		$x1=(-$b+sqrt($b^2-4*$a*$c))/2*$a;
		$x2=(-$b-sqrt($b^2-4*$a*$c))/2*$a;
		if ($b>0) $b="+$b";
		if ($c>0) $c="+$c";
		$rand="$a*X^2$b*X$c=0";
		$l=rand(0,1);
		if ($l==0)
		{
			$hit="round(max(x1,x2))=?";
			if ($x1>$x2)
			{
				$ans=round($x1);
			}
			else
			{
				$ans=round($x2);
			}
			if ($x1==$x2)
			{
				$ans=$x1;
			}
		}
		else
		{
			$hit="round(min(x1,x2))=?";
			if ($x1<$x2)
			{
				$ans=round($x1);
			}
			else
			{
				$ans=round($x2);
			}
			if ($x1==$x2)
			{
			$ans=$x1;
			}
		}
		for ($i=0;$i<strlen($rand);$i++)
		{
			$color = imagecolorallocate($canvas, rand(100,255),rand(100,255) , rand(100,255));
			imagefttext($canvas, 12, rand (-5,5), 5+12*$i, 50, $color, $this->ucaptcha->getCaptchaFontPath()."/LiberationMono-Bold.ttf", $rand[$i]);
		}
		imagefttext($canvas, 10, rand (-5,5), 20, 75, $color, $this->ucaptcha->getCaptchaFontPath()."/LiberationMono-Bold.ttf", $hit);
		$name = $this->ucaptcha->getFilename();
		$path=$this->ucaptcha->getAbsoluteCaptchaImgPath().'/'.$name;
		imagepng($canvas,$path);
		$captcha[0]=$name;
		$captcha[1]=$ans;
		return $captcha;
		}
}
?>