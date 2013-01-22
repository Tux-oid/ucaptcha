<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\MoreLess
 *
 * @author unknown rulinux user
 */
class MoreLess extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        $a = rand(1, 20);
        $b = rand(1, 20);
        $c = rand(1, 20);
        $d = rand(1, 20);
        $rand = "$a/$b ? $c/$d";
        $l = rand(0, 1);
        if ($l == 0) {
            $hit = "More number?";
            if ($a / $b > $c / $d) {
                $ans = "$a/$b";
            } else {
                $ans = "$c/$d";
            }
        } else {
            $hit = "Less number?";
            if ($a / $b < $c / $d) {
                $ans = "$a/$b";
            } else {
                $ans = "$c/$d";
            }
        }
        for ($i = 0; $i < strlen($rand); $i++) {
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imagefttext(
                $canvas,
                14,
                rand(-10, 10),
                24 + 14 * $i,
                50,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                $rand[$i]
            );
        }
        imagefttext(
            $canvas,
            15,
            rand(-5, 5),
            25,
            75,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $hit
        );
        $name = $this->ucaptcha->getFilename();
        $path = $this->ucaptcha->getAbsoluteCaptchaImgPath() . '/' . $name;
        imagepng($canvas, $path);
        $captcha[0] = $name;
        $captcha[1] = $ans;

        return $captcha;
    }

}

