<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\Limit
 *
 * @author unknown rulinux user
 */
class Limit extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        $rand = "lim(";
        $a1 = rand(0, 10);
        $rand .= "$a1+(1/x))=?";
        $ans = $a1;
        $hit = "x -> ∞";
        for ($i = 0; $i < strlen($rand); $i++) {
            $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
            imagefttext(
                $canvas,
                14,
                rand(-10, 10),
                4 + 14 * $i,
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
            15,
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

