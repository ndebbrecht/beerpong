<?php

namespace App\Controller;

use App\Entity\InfoMail;
use App\Entity\Subscriber;
use App\Form\InfoMailType;
use App\Repository\InfoMailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/infomail")
 */
class InfoMailController extends AbstractController
{
    /**
     * @Route("/", name="info_mail_index", methods={"GET"})
     */
    public function index(InfoMailRepository $infoMailRepository): Response
    {
        return $this->render('info_mail/index.html.twig', [
            'info_mails' => $infoMailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="info_mail_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $swift_mailer): Response
    {
        $infoMail = new InfoMail();
        $form = $this->createForm(InfoMailType::class, $infoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoMail->setPublished(new \DateTime("now"));
            var_dump($infoMail);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoMail);
            $entityManager->flush();

            /*$subscriber = $entityManager->getRepository(Subscriber::class)->findBy(array('unsubscribed' => false));
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__.'/../../.env');
            $address = $_SERVER['MY_DOMAIN'];
            foreach ($subscriber as $sub) {
                $message = new \Swift_Message($infoMail->getTopic());
                $message->setTo($sub->getEmail())
                    ->setBody(
                        $this->render('mails/template.html.twig', array(
                            'topic' => $infoMail->getTopic(),
                            'content' => $infoMail->getContent(),
                            'address' => $address,
                            'id' => $sub->getId()
                        )),
                        'text/html'
                    )
                    ->setFrom('no-reply@turnier.debbrecht.com', 'Obos Bier-Pomg');
                $swift_mailer->send($message);
            }*/

            return $this->redirectToRoute('info_mail_index');
        }

        return $this->render('info_mail/new.html.twig', [
            'info_mail' => $infoMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_mail_show", methods={"GET"})
     */
    public function show(InfoMail $infoMail): Response
    {
        return $this->render('info_mail/show.html.twig', [
            'info_mail' => $infoMail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_mail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoMail $infoMail): Response
    {
        $form = $this->createForm(InfoMailType::class, $infoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_mail_index');
        }

        return $this->render('info_mail/edit.html.twig', [
            'info_mail' => $infoMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_mail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfoMail $infoMail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoMail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoMail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_mail_index');
    }
}
