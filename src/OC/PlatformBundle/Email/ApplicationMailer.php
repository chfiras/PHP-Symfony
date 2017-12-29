<?php
// src/OC/PlatformBundle/Email/ApplicationMailer.php

namespace OC\PlatformBundle\Email;

use OC\PlatformBundle\Entity\Application;

class ApplicationMailer
{
  /**
   * @var \Swift_Mailer
   */
  private $mailer;

  public function __construct(\Swift_Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendNewNotification()
  {
    $message = new \Swift_Message(
      '3asba !',
      'Vous avez reçu une nouvelle candidature.'
    );

    $message
      ->addTo('hamouda1635@gmail.com') // Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
      ->addFrom('ch.firas00@gmail.com')
    ;

    $this->mailer->send($message);
  }
}
