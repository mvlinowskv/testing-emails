<?php

namespace App\Services\Mail;

use Psr\Cache\InvalidArgumentException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailDI extends \Symfony\Component\Mime\RawMessage
{
    private AdapterInterface $cache;
    private MailerInterface $mailer;
    const TEMPLATE = '_emails/register_email.html.twig';
    const SUBJECT = 'Rejestracja!';
    const ADDRESS_TO = 'klaudiaa.malinowskaa@gmail.com';

    public function __construct(AdapterInterface $cache, MailerInterface $mailer)
    {
        $this->cache = $cache;
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws InvalidArgumentException
     * @throws \Throwable
     */
    public function sendMail(): void
    {

        $this->cache->getItem('cache_key');

        $email = (new TemplatedEmail())
            ->from('noreply@softwebo.pl')
            ->to(self::ADDRESS_TO)
            ->subject(self::SUBJECT)
            ->htmlTemplate(self::TEMPLATE)
            ->context([
                'user' => self::ADDRESS_TO,
            ]);

        $this->mailer->send($email);
    }


}
