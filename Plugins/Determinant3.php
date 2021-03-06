<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\Determinant3
 *
 * @author unknown rulinux user
 */
class Determinant3 extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        $a11 = rand(0, 9);
        $a12 = rand(0, 9);
        $a13 = rand(0, 9);
        $a21 = rand(0, 9);
        $a22 = rand(0, 9);
        $a23 = rand(0, 9);
        $a31 = rand(0, 9);
        $a32 = rand(0, 9);
        $a33 = rand(0, 9);
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
            16,
            rand(-5, 5),
            40,
            20,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a11
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            80,
            20,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a12
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            120,
            20,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a13
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            40,
            35,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a21
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            80,
            35,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a22
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            120,
            35,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a23
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            40,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a31
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            80,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a32
        );
        imagefttext(
            $canvas,
            16,
            rand(-5, 5),
            120,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $a33
        );
        $name = $this->ucaptcha->getFilename();
        $path = $this->ucaptcha->getAbsoluteCaptchaImgPath() . '/' . $name;
        imagepng($canvas, $path);
        $captcha[0] = $name;
        $ans = ($a11 * $a22 * $a33) - ($a11 * $a23 * $a32) - ($a12 * $a21 * $a33) + ($a12 * $a23 * $a31) + ($a13 * $a21 * $a32) - ($a13 * $a22 * $a31);
        $captcha[1] = $ans;
        $captcha[2] = "";

        return $captcha;
    }

}

