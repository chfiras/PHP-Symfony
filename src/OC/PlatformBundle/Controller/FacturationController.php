<?php

// src/OC/PlatformBundle/Controller/FacturationController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Facturation;
use OC\PlatformBundle\Form\FacturationEditType;
use OC\PlatformBundle\Form\FacturationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


class FacturationController extends Controller
{
    public function listFacturesAction()
    {

        $listFactures = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Facturation')
            ->getFactures()
        ;
        $form = $this->get('form.factory')->create();

        $array[0]='Steg';
        $array[1]='Sonede';
        $array[2]='Télécom';
        $array[3]='Gestion des ressources';
        $array[4]='Salaire du personnel';
        $array[5]='Frais de location';
        $array[6]='Divers frais';


        return $this->render('OCPlatformBundle:Facturation:list.html.twig', array(
            'listFactures' => $listFactures,
            'form'=>$form->createView(),
            'array'=>$array
        ));
    }

  public function addAction(Request $request)
  {
    $advert = new Facturation();
    $form   = $this->get('form.factory')->create(FacturationType::class, $advert);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($advert);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      return $this->redirectToRoute('oc_platform_listFactures');
    }

    return $this->render('OCPlatformBundle:Facturation:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $advert = $em->getRepository('OCPlatformBundle:Facturation')->find($id);

    if (null === $advert) {
      throw new NotFoundHttpException("La facture d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(FacturationEditType::class, $advert);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirectToRoute('oc_platform_listFactures');
    }

    return $this->render('OCPlatformBundle:Facturation:edit.html.twig', array(
      'facture' => $advert,
      'form'   => $form->createView(),
    ));
  }


    public function delAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Facturation')->find($id);

        $em->remove($advert);
        $em->flush();
        return $this->redirectToRoute('oc_platform_listFactures');


    }

    public function facAction($id,Request $request)
   {
       $facture = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Facturation')->find($id);

       $array[0]='Steg';
       $array[1]='Sonede';
       $array[2]='Télécom';
       $array[3]='Gestion des ressources';
       $array[4]='Salaire du personnel';
       $array[5]='Frais de location';
       $array[6]='Divers frais';


       $html = $this->renderView('OCPlatformBundle:Facturation:fac.html.twig', array(
           'facture' => $facture,
           'array'=>$array
       ));

       $header = $this->renderView('OCPlatformBundle:Facturation:header.html.twig',array(
       'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $request->getBasePath()
   ));

       $footer = $this->renderView('OCPlatformBundle:Facturation:footer.html.twig',array(
           'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $request->getBasePath()
       ));

       return new Response(
           $this->get('knp_snappy.pdf')
               ->getOutputFromHtml($html,array(
               'encoding'=>'utf-8',
               'images' => true,
               'lowquality' => false,
                   'header-html'=>$header,
                   'footer-html'=>$footer,
                   'dpi'=>300,
               )),
           200,
           array(
               'Content-Type'          => 'application/pdf',
               'Content-Disposition'   => 'attachment; filename="facture '.$facture->getPeriode()->format("M Y").'.pdf"'
           )
       );


   }

}
