<?php

namespace App\MessageHandler;

use App\Message\NewFruitMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class NewFruitMessageHandler 
{

    private MailerInterface $mailer;

    public function __construct(private MailerInterface $mailerInterface)
    {
        $this->mailer = $mailerInterface;
    }

    public function __invoke(NewFruitMessage $newFruitMessage)
    {
        $email = (new Email())
            ->from('fruits@gmail.com')
            ->to('test@gmail.com')
            ->subject($newFruitMessage->getFruit()->getName() . ' was succefully loaded!')
            ->text("Dear Sir/Madam, \n A new fruit named " . $newFruitMessage->getFruit()->getName(). " with ID " . $newFruitMessage->getFruit()->getId() . " was loaded to the system database successfully!");
        

        $this->mailer->send($email);
            
    }
}