<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\Sqeq
 *
 * @author Vladimir Gorbunov <truedaemon@gmail.com>  a.k.a. SystemV
 * @author Peter Vasilevsky <tuxoiduser@gmail.com> a.k.a. Tux-oid
 */
class Sqeq extends AbstractPlugin
{
    /**
     * Get non-zero random number for range [$from, $to]
     *
     * @param $from
     * @param $to
     * @return int
     */
    private function randExceptZero($from, $to)
    {
        do {
            $result = rand($from, $to);
        } while ($result == 0);

        return $result;
    }

    /**
     * Format equation to string
     *
     * @param $a
     * @param $b
     * @param $c
     * @return string
     */
    private function format($a, $b, $c)
    {
        $str = '';
        /* $a */
        if (abs($a) == 1) {
            if ($a < 0) {
                $str .= '-';
            }
        } else {
            $str .= $a;
        }
        $str .= 'X^2';
        /* $b */
        if ($b != 0) {
            if (abs($b) == 1) {
                if ($b > 0) {
                    $str .= '+';
                } else {
                    $str .= '-';
                }
            } else {
                if ($b > 0) {
                    $str .= '+';
                }
                $str .= $b;
            }
            $str .= 'X';
        }
        /* $c */
        if ($c > 0) {
            $str .= '+';
        }
        $str .= $c . '=0';

        return $str;
    }


    /**
     * Algorithm - Vieta's theorem: b = -(x1 + x2), c = x1 * x2
     *
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        /* Roots */
        $x1 = $this->randExceptZero(-20, 20);
        $x2 = $this->randExceptZero(-20, 20);
        /* Coefficients */
        $a = $this->randExceptZero(-5, 5);
        $b = -($x1 + $x2) * $a;
        $c = ($x1 * $x2) * $a;
        switch (rand(0, 1)) {
            case 0:
                $hit = "max(x1, x2)=?";
                $answer = max($x1, $x2);
                break;
            case 1:
                $hit = "min(x1, x2)=?";
                $answer = min($x1, $x2);
                break;
        }
        /* Format output */
        $eq = $this->format($a, $b, $c);
        for ($i = 0; $i < strlen($eq); $i++) {
            $color = imagecolorallocate(
                $canvas,
                rand(100, 255),
                rand(100, 255),
                rand(100, 255)
            );
            imagefttext(
                $canvas,
                12,
                rand(-5, 5),
                5 + 12 * $i,
                50,
                $color,
                $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
                $eq[$i]
            );
        }
        imagefttext($canvas, 10, rand(-5, 5), 20, 75, $color, $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf", $hit);
        $fileName = $this->ucaptcha->getFilename();
        imagepng($canvas);
        $captcha[0] = $fileName;
        $captcha[1] = (string)$answer;

        return $captcha;
    }

}

