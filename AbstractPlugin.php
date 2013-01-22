<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha;

/**
 * RL\Ucaptcha\AbstractPlugin
 *
 * @author Tux-oid
 * @license BSDL
 */
abstract class AbstractPlugin
{
    /**
     * @var \RL\Ucaptcha\Ucaptcha
     */
    protected $ucaptcha;

    /**
     * Constructor
     *
     * @param \RL\Ucaptcha\Ucaptcha $ucaptcha
     */
    public function __construct($ucaptcha)
    {
        $this->ucaptcha = $ucaptcha;
    }


    /**
     * Generates a captcha image and an answer for a question drawn in the image
     *
     * @param $canvas
     * @return mixed
     */
    abstract public function generateImage($canvas);

    /**
     * Return level of registered plugin
     *
     * @return int
     */
    abstract public function getPluginLevel();
}
