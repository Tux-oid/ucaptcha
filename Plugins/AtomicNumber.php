<?php
/************************************************************
 * Rulinux captcha library                                  *
 *                                                          *
 *                                                          *
 ************************************************************/

namespace RL\Ucaptcha\Plugins;

use RL\Ucaptcha\AbstractPlugin;

/**
 * RL\UCaptcha\Plugins\AtomicNumber
 *
 * @author Dorif
 */
class AtomicNumber extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function generateImage($canvas)
    {
        $X[1] = "H";
        $X[2] = "He";
        $X[3] = "Li";
        $X[4] = "Be";
        $X[5] = "B";
        $X[6] = "C";
        $X[7] = "N";
        $X[8] = "O";
        $X[9] = "F";
        $X[10] = "Ne";
        $X[11] = "Na";
        $X[12] = "Ma";
        $X[13] = "Al";
        $X[14] = "Si";
        $X[15] = "P";
        $X[16] = "S";
        $X[17] = "Cl";
        $X[18] = "Ar";
        $X[19] = "K";
        $X[20] = "Ca";
        $X[21] = "Sc";
        $X[22] = "Ti";
        $X[23] = "V";
        $X[24] = "Cr";
        $X[25] = "Mn";
        $X[26] = "Fe";
        $X[27] = "Co";
        $X[28] = "Ni";
        $X[29] = "Cu";
        $X[30] = "Zn";
        $X[31] = "Ga";
        $X[32] = "Ge";
        $X[33] = "As";
        $X[34] = "Se";
        $X[35] = "Br";
        $X[36] = "Kr";
        $X[37] = "Rb";
        $X[38] = "Sr";
        $X[39] = "Y";
        $X[40] = "Zr";
        $X[41] = "Nb";
        $X[42] = "Mo";
        $X[43] = "Tc";
        $X[44] = "Ru";
        $X[45] = "Rh";
        $X[46] = "Pd";
        $X[47] = "Ag";
        $X[48] = "Cd";
        $X[49] = "In";
        $X[50] = "Sn";
        $X[51] = "Sb";
        $X[52] = "Te";
        $X[53] = "I";
        $X[54] = "Xe";
        $X[55] = "Cs";
        $X[56] = "Ba";
        $X[57] = "La";
        $X[58] = "Ce";
        $X[59] = "Pr";
        $X[60] = "Nd";
        $X[61] = "Pm";
        $X[62] = "Sm";
        $X[63] = "Eu";
        $X[64] = "Gd";
        $X[65] = "Tb";
        $X[66] = "Dy";
        $X[67] = "Ho";
        $X[68] = "Er";
        $X[69] = "Tm";
        $X[70] = "Yb";
        $X[71] = "Lu";
        $X[72] = "Hf";
        $X[73] = "Ta";
        $X[74] = "W";
        $X[75] = "Re";
        $X[76] = "Os";
        $X[77] = "Ir";
        $X[78] = "Pt";
        $X[79] = "Au";
        $X[80] = "Hg";
        $X[81] = "Tl";
        $X[82] = "Pb";
        $X[83] = "Bi";
        $X[84] = "Po";
        $X[85] = "At";
        $X[86] = "Rn";
        $X[87] = "Fr";
        $X[88] = "Ra";
        $X[89] = "Ac";
        $X[90] = "Th";
        $X[91] = "Pa";
        $X[92] = "U";
        $X[93] = "Np";
        $X[94] = "Pl";
        $X[95] = "Am";
        $X[96] = "Cm";
        $X[97] = "Bk";
        $X[98] = "Cf";
        $X[99] = "Es";
        $X[100] = "Fm";
        $X[101] = "Md";
        $X[102] = "No";
        $X[103] = "Lr";
        $X[104] = "Rf";
        $X[105] = "Db";
        $X[106] = "Sg";
        $X[107] = "Bh";
        $X[108] = "Hs";
        $X[109] = "Mt";
        $X[110] = "Ds";
        $X[111] = "Rg";
        $X[112] = "Cn";
        $X[113] = "Uut";
        $X[114] = "Uuq";
        $X[114] = "Uup";
        $X[116] = "Uuh";
        $X[117] = "Uus";
        $X[118] = "Uuo";
        $X[119] = "Uue";
        $X[120] = "Ubn";
        $X[121] = "Ubu";
        $X[122] = "Ubb";
        $X[123] = "Ubt";
        $X[124] = "Ubq";
        $X[125] = "Ubp";
        $X[126] = "Ubh";

        $ans = rand(1, 126);
        $hit = "Z = ?";
        $color = imagecolorallocate($canvas, rand(100, 255), rand(100, 255), rand(100, 255));
        imagefttext(
            $canvas,
            32,
            rand(-10, 10),
            60,
            50,
            $color,
            $this->ucaptcha->getCaptchaFontPath() . "/LiberationMono-Bold.ttf",
            $X[$ans]
        );
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

