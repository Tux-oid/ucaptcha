<?php
class Pushkin implements PluginInterface
{

	function getRandomQuestion()
	{
		//
		$res[0] = "Мой дядя самых честных правил,\nКогда не в шутку занемог\nОн уважать себя заставил...\n";//FIXME:translate this
		$l = rand(0, 2);
		switch($l)
		{
			case 0:
				$res[1] = 'Фамилия автора?'; //Получается из базы рандомно, может быть фамилия, имя, или отчество.
				$res[2] = 'Пушкин';
				break;
			case 1:
				$res[1] = 'Имя автора?'; //Получается из базы рандомно, может быть фамилия, имя, или отчество.
				$res[2] = 'Александр';
				break;
			case 2:
				$res[1] = 'Отчество автора?'; //Получается из базы рандомно, может быть фамилия, имя, или отчество.
				$res[2] = 'Сергеевич';
				break;
		}
		//$res[2]='FixMe';
		return $res;
	}

	function generateImage($canvas)
	{
		$txt = $this->getRandomQuestion();
		$rand = $txt[0];
		$lines = explode("\n", $rand);
		for($i = 0; $i < count($lines); $i++)
		{
			$color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
			imagefttext($canvas, 7 + rand(0, 3), rand(-5, 5), 5, 10 + $i * 10, $color, $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf", $lines[$i]);
		}

		imagefttext($canvas, 8, rand(-5, 5), 5, 10 + $i * 10, $color, $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf", $txt[1]);
		$name = $this->ucaptcha->getFilename();
		$path=$this->ucaptcha->getAbsoluteCaptchaImgPath().'/'.$name;
		imagepng($canvas,$path);
		$captcha[0]=$name;
		$captcha[1] = $txt[2];
		return $captcha;
	}
}

?>
