<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\Determinant2
 *
 * @author unknown rulinux user
 */
class Determinant2 extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        $a = rand(0, 9);
        $b = rand(0, 9);
        $c = rand(0, 9);
        $d = rand(0, 9);
        $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
        imageline($canvas, 20, 10, 20, 60, $color);
        imageline($canvas, 160, 10, 160, 60, $color);
        $rand = " =?";
        for ($i = 0; $i < strlen($rand); $i++) {
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imagefttext(
                $canvas,
                20,
                rand(-45, 45),
                144 + 20 * $i,
                50,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                $rand[$i]
            );
        }
        $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
        imagefttext(
            $canvas,
            20,
            rand(-5, 5),
            40,
            20,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a
        );
        imagefttext(
            $canvas,
            20,
            rand(-5, 5),
            40,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $b
        );
        imagefttext(
            $canvas,
            20,
            rand(-5, 5),
            120,
            20,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $c
        );
        imagefttext(
            $canvas,
            20,
            rand(-5, 5),
            120,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $d
        );
        $name = $this->ucaptcha->getFilename();
        $path = $this->ucaptcha->getAbsoluteCaptchaImgPath() . '/' . $name;
        imagepng($canvas, $path);
        $captcha[0] = $name;
        $ans = ($a * $d) - ($b * $c);
        $captcha[1] = $ans;

        return $captcha;
    }

}

