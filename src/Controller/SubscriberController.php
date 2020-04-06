<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\SubscriberType;
use App\Repository\SubscriberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class SubscriberController extends AbstractController
{
    /**
     * @Route("/subscribe", name="subscriber_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subscriber = new Subscriber();
        $subscriber->setUnsubscribed(false);
        $form = $this->createForm(SubscriberType::class, $subscriber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscriber);
            $entityManager->flush();

            return $this->redirectToRoute('subscriber_success');
        }

        return $this->render('subscriber/new.html.twig', [
            'subscriber' => $subscriber,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/subscribed", name="subscriber_success")
     */
    public function success()
    {
        return $this->render("subscriber/success.html.twig");
    }

    /**
     * @Route("/unsubscribe/{id}", name="unsubscribe", methods={"GET"})
     */
    public function show(Subscriber $subscriber): Response
    {
        $subscriber->setUnsubscribed(true);
        $this->getDoctrine()->getManager()->flush();
        return $this->render('subscriber/unsubscribed.html.twig');
    }
}
