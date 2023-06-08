<?php

namespace App\Controller;

use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Mail\MailDI;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MailController extends AbstractController
{

    /**
     * @Route("/mail", name="mail")
     * @throws TransportExceptionInterface|InvalidArgumentException
     */
    public function index(MailDI $mailDI): Response
    {
        $mailDI->sendMail();

        return $this->render('base.html.twig');
    }
}
