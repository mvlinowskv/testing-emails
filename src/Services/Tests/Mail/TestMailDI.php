<?php

namespace App\Services\Tests\Mail;
use App\Services\Mail\MailDI;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class TestMailDI extends WebTestCase {

    /**
     * @throws \Throwable
     * @throws TransportExceptionInterface
     * @throws InvalidArgumentException
     */
    public function testSendEmail()
    {
        $mailerMock = $this->createMock(MailerInterface::class);
        $cacheMock = $this->createMock(AdapterInterface::class);
        $mailDI = new MailDI($cacheMock, $mailerMock);

        $mailDI->sendMail();

        $this->assertNotEmpty($mailDI, 'Welcome');
        $this->assertSame('Rejestracja!', $mailDI::SUBJECT);
        $this->assertSame('klaudiaa.malinowskaa@gmail.com', $mailDI::ADDRESS_TO);

    }
}