<?php
namespace OC\PlatformBundle\Command;

use OC\PlatformBundle\Controller\AdvertController;
use Pyrus\DER\String;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Swift_Message;
use \Swift_Image;



class EmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('notif:my_command')
            ->setDescription('Command description')
            ->addArgument('my_argument', InputArgument::OPTIONAL, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager()
                   ->getRepository('OCPlatformBundle:Advert')
                   ->getFiches();
        foreach ($em as $e)
        {

            $mail = $e->getMailPrincipal();

            foreach($e->getNomDeDomaine() as $n)
            {
                if(strtotime($n->getDateDExpiration()->format('d-M-Y'))-strtotime(date('d-M-Y'))<=172800 && strtotime($n->getDateDExpiration()->format('d-M-Y'))-strtotime(date('d-M-Y'))>=0)
                {
                    $output->writeln('sending !');
                    //send mail
                    require_once '/home/mah/Bureau/Stage/vendor/swiftmailer/swiftmailer/lib/swift_required.php';


                    $message = \Swift_Message::newInstance()
                        //(new Swift_Message('Votre nom de domaine sera bientôt expiré'))
                        ->setSubject('Votre nom de domaine sera bientôt expiré')
                        ->setFrom('mahmoud.maalej@supcom.tn')
                        ->setTo('hamouda1635@gmail.com');
                    $data['image_src'] = $message->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/hypermedia.png'));
                    $data['mailico'] = $message->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/mail.png'));
                    $data['phone']=$message->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/phone.png'));
                    $data['fax']=$message->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/fax.png'));
                    $cre = $n->getDateDecreation();
                    $exp = $n->getDateDExpiration();
                    $domaine = $n->getDomaine();
                    $data['cre']=$cre;
                    $data['dom']=$domaine;
                    $data['exp']=$exp;
                    $data['mail']=$mail;
                    $data['client']=$e->getClient();
                    $message->setBody($this->getContainer()->get('templating')->render('mail.html.twig',$data),'text/html')
                    ;

                    $this->getContainer()->get('mailer')->send($message);

                }
            }
        }

        $factures = $this->getContainer()->get('doctrine')->getManager()
        ->getRepository('OCPlatformBundle:Facturation')
        ->findAll();

        foreach ($factures as $f)
        {
            foreach ($f->getblocFacture() as $b)
            {
                if(strtotime($b->getDateFin()->format('d-M-Y'))-strtotime(date('d-M-Y'))<=172800 && strtotime($b->getDateFin()->format('d-M-Y'))-strtotime(date('d-M-Y'))>=0)
                {
                    $output->writeln('sending !');
                    //send mail
                    require_once '/home/mah/Bureau/Stage/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

                    $message1 = \Swift_Message::newInstance()
                        //(new Swift_Message('Votre nom de domaine sera bientôt expiré'))
                        ->setSubject('Rappel pour la facture de '.$f->getPeriode()->format('M Y'))
                        ->setFrom('mahmoud.maalej@supcom.tn')
                        ->setTo('hamouda1635@gmail.com');
                    $data1['cat']=$b->getcategorie();
                    $data1['image_src'] = $message1->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/hypermedia.png'));
                    $data1['mailico'] = $message1->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/mail.png'));
                    $data1['phone']=$message1->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/phone.png'));
                    $data1['fax']=$message1->embed(Swift_Image::fromPath('/home/mah/Bureau/Stage/web/img/fax.png'));
                    $exp = $b->getDateFin();
                    $data1['exp']=$exp;
                    $data1['note']=$b->getnote();
                    $data1['per']=$f->getPeriode();
                    $data1['mail']='hamouda1635@gmail.com';
                    $message1->setBody($this->getContainer()->get('templating')->render('mailFacture.html.twig',$data1),'text/html')
                    ;

                    $this->getContainer()->get('mailer')->send($message1);

                }
            }

        }
    }

}