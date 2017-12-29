<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AdvertController extends Controller
{

  public function addAction(Request $request)
  {
      $e = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Pack')->findAll();
    $advert = new Advert();
    $array = array();
    foreach ($e as $elem)
    {
        $array[] = $elem->getname();
    }
    $form   = $this->get('form.factory')->create(AdvertType::class, $advert, array('pack'=>$array));

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($advert);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      return $this->redirectToRoute('oc_platform_tablesfiches');
    }

    return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {
      $e = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Pack')->findAll();
      $em = $this->getDoctrine()->getManager();

    $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

    if (null === $advert) {
      throw new NotFoundHttpException("La fiche client d'id ".$id." n'existe pas.");
    }
      $array = array();

      foreach ($e as $elem)
      {
          $array[] = $elem->getname();
      }
      $form   = $this->get('form.factory')->create(AdvertType::class, $advert, array('pack'=>$array));

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirectToRoute('oc_platform_tablesfiches');
    }

    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert,
      'form'   => $form->createView(),
    ));
  }


    public function tabledefichesAction()
    {

        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getFiches()
        ;


        $form = $this->get('form.factory')->create();

        $packs = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Pack')->findAll();


        return $this->render('OCPlatformBundle:Advert:tabledefiches.html.twig'
            , array(
                'listFiches' => $listAdverts,
                'form'   => $form->createView(),
                'packs'=>$packs

            ));
    }

    public function delAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

            $em->remove($advert);
            $em->flush();
            return $this->redirectToRoute('oc_platform_tablesfiches');

    }

    public function listDomaineAction()
    {
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getFiches()
        ;


        $form = $this->get('form.factory')->create();



        return $this->render('OCPlatformBundle:Advert:listDomaine.html.twig'
            , array(
                'listDomaine' => $listAdverts,
                'form'   => $form->createView(),

            ));
    }
    public function listClientAction()
    {


        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getFiches()
        ;


        $form = $this->get('form.factory')->create();

        return $this->render('OCPlatformBundle:Advert:listClient.html.twig'
            , array(
                'listClient' => $listAdverts,
                'form'   => $form->createView(),

            ));


    }

    public function listEmailsAction()
    {
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getEmails()
        ;

        $form = $this->get('form.factory')->create();

        return $this->render('OCPlatformBundle:Advert:listEmails.html.twig'
            , array(
                'listEmails' => $listAdverts,
                'form'   => $form->createView(),

            ));
    }

    public function changeStateAction($fid,$nid, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $State = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getState($fid,$nid)
        ;


        if (!$State) {
            throw $this->createNotFoundException(
                'No Domain name found for ids : '.$fid.' and '.$nid
            );
        }

               foreach ($State as $s)
               {
                   foreach ($s->getNomDeDomaine() as $n)
                   {
                       if($n->getetat() == 0)
                       {
                           $n->setetat(1);
                       }
                       else
                       {
                           $n->setetat(0);
                       }
                       $em->flush();
                       return $this->redirectToRoute('oc_platform_tablesfiches');
                   }
               }
    }

}
