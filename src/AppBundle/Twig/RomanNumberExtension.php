<?php
// src/AppBundle/Twig/RomanNumberExtension.php
namespace AppBundle\Twig;

use Exception;

use Twig_Extension,
    Twig_SimpleFilter;

class RomanNumberExtension extends Twig_Extension
{
    private $romanNotation = [
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
    ];

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('roman_number', [$this, 'romanNumber']),
        ];
    }

    public function romanNumber($integer)
    {
        if( !is_int($integer) )
            throw new Exception("Invalid argument, int expected");

        return $this->intToRomanNumber($integer);
    }

    private function intToRomanNumber($integer)
    {
        $romanNumber = '';

        while($integer > 0)
        {
            foreach($this->romanNotation as $roman => $arabic)
            {
                if( $integer >= $arabic )
                {
                    $integer     -= $arabic;
                    $romanNumber .= $roman;

                    break;
                }
            }

        }

        return $romanNumber;
    }

    public function getName()
    {
        return 'roman_number_extension';
    }
}