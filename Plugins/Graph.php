<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\Graph
 *
 * @author unknown rulinux user
 */
class Graph extends AbstractPlugin
{

    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        imagesetthickness($canvas, 1);
        $var = rand(0, 1);
        $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
        $liney = rand(3, 6);
        $linex = rand(6, 12);
        for ($i = $liney; $i > 0; $i--) {
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imageline($canvas, 10, $i * 60 / $liney, 200, $i * 60 / $liney, $color);
            imagefttext(
                $canvas,
                8,
                rand(-45, 45),
                3,
                $i * 60 / $liney,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                $liney - $i
            );
        }
        for ($i = 0; $i < $linex; $i++) {
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imageline($canvas, 30 + $i * 160 / $linex, 0, 30 + $i * 160 / $linex, 70, $color);
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imagefttext(
                $canvas,
                8,
                rand(-45, 45),
                30 + $i * 160 / $linex,
                80,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                $i
            );
        }
//		$color = imagecolorallocate($canvas, rand(100,255),rand(100,255) , rand(100,255));
        imagesetthickness($canvas, 1);
        $x = rand(0, $linex - 1);
        $y = rand(0, $liney - 1);
        for ($i = -5; $i < 5; $i++) {
            $xr = rand(0, $linex);
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            $yr = rand(0, $liney);
            imageline(
                $canvas,
                30 + $x * 160 / $linex,
                ($liney - $y) * 60 / $liney,
                30 + $xr * 160 / $linex,
                ($liney - $yr) * 60 / $liney,
                $color
            );
        }
        $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
        if ($var) {
            imagefttext(
                $canvas,
                20,
                rand(-45, 45),
                40 + 20,
                50,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                "y=?"
            );
        } else {
            imagefttext(
                $canvas,
                12,
                rand(-45, 45),
                100,
                70,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                "X=?"
            );
        }
        $name = $this->ucaptcha->getFilename();
        $path = $this->ucaptcha->getAbsoluteCaptchaImgPath() . '/' . $name;
        imagepng($canvas, $path);
        $captcha[0] = $name;
        if ($var) {
            $captcha[1] = $y;
        } else {
            $captcha[1] = $x;
        }

        return $captcha;
    }

}

