<?php

namespace App\Controller;

use App\Entity\InfoMail;
use App\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $currTournament = $em->getRepository(Tournament::class)->findOneBy(array(), array('begin' => 'DESC'));
        $infoMails = $em->getRepository(InfoMail::class)->findBy(array(), array('published' => 'DESC'), 3);
        return $this->render('admin/index.html.twig', [
            'tournament' => $currTournament,
            'infoMails' => $infoMails
        ]);
    }
}
