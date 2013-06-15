<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha;

require_once "plugs.dcfg.php";
require_once "UcaptchaInterface.php";

/**
 * RL\Ucaptcha\Ucaptcha
 *
 * @author AiFilTr0
 * @author Peter Vasilevsky <tuxoiduser@gmail.com> a.k.a. Tux-oid
 */
class Ucaptcha implements UcaptchaInterface
{
    /**
     * @var string
     */
    protected $captchaPluginPath;
    /**
     * @var string
     */
    protected $captchaFontPath;
    /**
     * @var string
     */
    protected $captchaImgPath;
    /**
     * @var string
     */
    protected $captchaTplPath;
    /**
     * @var
     */
    protected $uCaptchaPlugins;

    /**
     * Constructor
     *
     * @param string $captchaPluginPath
     * @param string $captchaFontPath
     * @param string $captchaImgPath
     * @param string $captchaTplPath
     */
    public function __construct(
        $captchaPluginPath = "/Plugins",
        $captchaFontPath = "/fonts",
        $captchaImgPath = "/cpt",
        $captchaTplPath = "/images"
    ) {
        global $uCaptchaPlugins;
        $this->uCaptchaPlugins = $uCaptchaPlugins;
        $this->captchaPluginPath = $captchaPluginPath;
        $this->captchaFontPath = $captchaFontPath;
        $this->captchaImgPath = $captchaImgPath;
        $this->captchaTplPath = $captchaTplPath;
    }

    /**
     * @param int $level
     * @return null|string
     * @throws \Exception
     */
    public function draw($level = 0)
    {
        if (count($this->uCaptchaPlugins[$level]) == 0) {
            $image = null;
        } else {
            if (!in_array($level, $this->getPluginsLevels())) {
                throw new \Exception('Level is invalid');
            }
            $captcha = $this->generateImage($level);
            $_SESSION['captchaKeyString'] = $captcha[1];
            $image = $this->getCaptchaImgPath() . '/' . $captcha[0];
            $_SESSION['captchaImage'] = $captcha[1]; //FIXME:save information about image, keystring and date to file
        }

        return $image;
    }

    /**
     * @param $level
     * @return mixed
     */
    protected function generateImage($level)
    {
        $pl = rand(0, count($this->uCaptchaPlugins[$level]) - 1);
        $plugin = '\\UCaptcha\\Plugins\\' . $this->uCaptchaPlugins[$level][$pl];
        /** @var $generator \RL\Ucaptcha\AbstractPlugin */
        $generator = new $plugin($this);
        $canvas = $this->prepareCanvas();
        $captcha = $generator->generateImage($canvas);

        return $captcha;
    }

    /**
     * @param $val
     * @return bool
     */
    public function check($val)
    {
        if (!isset($_SESSION['captchaKeyString'])) {
            return false;
        }
        $answer = $_SESSION['captchaKeyString'];
        /* Check captcha type */
        $type = gettype($answer);
        switch ($type) {
            case 'integer':
            case 'double':
                if (!is_numeric($val)) {
                    return false;
                }
        }
        unlink(
            $this->getAbsoluteCaptchaImgPath() . '/' . $_SESSION['captchaImage']
        ); //FIXME:remove files with creation date more than 5 hours ago
        return ($val == $answer);
    }

    /**
     *
     */
    public function reset()
    {
        $_SESSION['captchaKeyString'] = null;
        unlink($this->getAbsoluteCaptchaImgPath() . '/' . $_SESSION['captchaImage']);
        $_SESSION['captchaImage'] = null;
    }

    /**
     * @param $uuid
     * @param $answer
     * @return int
     */
    protected function dbStoreAnswer($uuid, $answer)
    {
        return 0;
    }

    /**
     * @param $uuid
     * @return int
     */
    protected function dbGetAnswer($uuid)
    {
        return 0;
    }

    /**
     * @return resource
     */
    protected function prepareCanvas()
    {
        $this->captchaTplPath;
        $canvas = imagecreatefrompng($this->getAbsoluteCaptchaTplPath() . "/template.png");

        return $canvas;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return md5(microtime() + rand(0, 255)) . '.png';
    }

    /**
     * @return int
     */
    public function getPluginsLevelsCount()
    {
        return count($this->uCaptchaPlugins);
    }

    /**
     * @return array
     */
    public function getPluginsLevels()
    {
        $ret = array();
        foreach ($this->uCaptchaPlugins as $key => $value) {
            $ret[] = $key;
        }

        return $ret;
    }

    /**
     * @param $captchaFontPath
     */
    public function setCaptchaFontPath($captchaFontPath)
    {
        $this->captchaFontPath = $captchaFontPath;
    }

    /**
     * @return string
     */
    public function getCaptchaFontPath()
    {
        return $this->captchaFontPath;
    }

    /**
     * @return string
     */
    public function getAbsoluteCaptchaFontPath()
    {
        return __DIR__ . $this->captchaFontPath;
    }

    /**
     * @param $captchaImgPath
     */
    public function setCaptchaImgPath($captchaImgPath)
    {
        $this->captchaImgPath = $captchaImgPath;
    }

    /**
     * @return string
     */
    public function getCaptchaImgPath()
    {
        return $this->captchaImgPath;
    }

    /**
     * @return string
     */
    public function getAbsoluteCaptchaImgPath()
    {
        return __DIR__ . $this->captchaImgPath;
    }

    /**
     * @param $captchaPluginPath
     */
    public function setCaptchaPluginPath($captchaPluginPath)
    {
        $this->captchaPluginPath = $captchaPluginPath;
    }

    /**
     * @return string
     */
    public function getCaptchaPluginPath()
    {
        return $this->captchaPluginPath;
    }

    /**
     * @return string
     */
    public function getAbsoluteCaptchaPluginPath()
    {
        return __DIR__ . $this->captchaPluginPath;
    }

    /**
     * @param $captchaTplPath
     */
    public function setCaptchaTplPath($captchaTplPath)
    {
        $this->captchaTplPath = $captchaTplPath;
    }

    /**
     * @return string
     */
    public function getCaptchaTplPath()
    {
        return $this->captchaTplPath;
    }

    /**
     * @return string
     */
    public function getAbsoluteCaptchaTplPath()
    {
        return __DIR__ . $this->captchaTplPath;
    }

}

