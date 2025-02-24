<?php
namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{
    private MailerInterface $mailer;
    private Environment $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

     public function sendContactEmail(string $to, string $name, string $email, string $subject, string $message): void
    {
        $emailContent = $this->twig->render('emails/contact.html.twig', [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);

        $email = (new Email())
            ->from($email)
            ->to($to)
            ->subject('Nouveau message de contact')
            ->html($emailContent);

        $this->mailer->send($email);
    }
}
