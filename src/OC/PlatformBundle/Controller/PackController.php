<?php


namespace OC\PlatformBundle\Controller;


use OC\PlatformBundle\Entity\Pack;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Form\PackEditType;
use OC\PlatformBundle\Form\PackType;


class PackController extends Controller
{


    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pack = $em->getRepository('OCPlatformBundle:Pack')->find($id);

        if (null === $pack) {
            throw new NotFoundHttpException("Le pack d'id ".$id." n'existe pas.");
        }

        $form1 = $this->get('form.factory')->create(PackEditType::class, $pack);

        if ($request->isMethod('POST') && $form1->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre annonce
            $em->flush();
            return $this->redirectToRoute('oc_platform_packs');
        }

        return $this->render('OCPlatformBundle:Pack:edit.html.twig', array(
            'form1'   => $form1->createView(),
            'pack' => $pack
        ));
    }

    public function delAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $pack = $em->getRepository('OCPlatformBundle:Pack')->find($id);
            $em->remove($pack);
            $em->flush();
            return $this->redirectToRoute('oc_platform_packs');

        //return $this->render('OCPlatformBundle:Advert:azerty.html.twig');

    }

    public function listPacksAction(Request $request)
    {

        $pack = new Pack();
        $form   = $this->get('form.factory')->create(PackType::class, $pack);

        $listPacks = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Pack')
            ->getPacks();


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pack);
            $em->flush();
            return $this->redirectToRoute('oc_platform_packs');
        }

        return $this->render('OCPlatformBundle:Pack:list.html.twig', array(
            'form' => $form->createView(),
            'listPacks'=>$listPacks,
    ));
    }
}