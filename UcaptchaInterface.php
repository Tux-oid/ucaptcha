<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha;


interface UcaptchaInterface {

    /**
     * @param int $level
     * @return null|string
     * @throws \Exception
     */
    public function draw($level = 0);

    /**
     * @param $val
     * @return bool
     */
    public function check($val);

    /**
     *
     */
    public function reset();

    /**
     * @return string
     */
    public function getFilename();

    /**
     * @return int
     */
    public function getPluginsLevelsCount();

    /**
     * @return array
     */
    public function getPluginsLevels();

    /**
     * @param $captchaFontPath
     */
    public function setCaptchaFontPath($captchaFontPath);

    /**
     * @return string
     */
    public function getCaptchaFontPath();

    /**
     * @return string
     */
    public function getAbsoluteCaptchaFontPath();

    /**
     * @param $captchaImgPath
     */
    public function setCaptchaImgPath($captchaImgPath);

    /**
     * @return string
     */
    public function getCaptchaImgPath();

    /**
     * @return string
     */
    public function getAbsoluteCaptchaImgPath();

    /**
     * @param $captchaPluginPath
     */
    public function setCaptchaPluginPath($captchaPluginPath);

    /**
     * @return string
     */
    public function getCaptchaPluginPath();

    /**
     * @return string
     */
    public function getAbsoluteCaptchaPluginPath();

    /**
     * @param $captchaTplPath
     */
    public function setCaptchaTplPath($captchaTplPath);

    /**
     * @return string
     */
    public function getCaptchaTplPath();

    /**
     * @return string
     */
    public function getAbsoluteCaptchaTplPath();
}
