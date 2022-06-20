<?php declare(strict_types=1);

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
           // new TwigFunction('get_flash_bag', [$this, 'getFlashBag']),
        ];
    }

    public function getFlashBag()
    {

    }
}