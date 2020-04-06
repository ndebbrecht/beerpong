<?php

namespace App\Controller;

use App\Entity\InfoMail;
use App\Entity\Team;
use App\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StartController extends AbstractController
{
    /**
     * @Route("/", name="start")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $latestInfo = $em->getRepository(InfoMail::class)->findOneBy(array(), array('published' => 'DESC'));
        $currTournament = $em->getRepository(Tournament::class)->findOneBy(array(), array('begin' => 'DESC'));
        $signedTeams = $em->getRepository(Team::class)->count(array('tournament' => $currTournament));

        return $this->render('start/index.html.twig', [
            'info' => $latestInfo,
            'tournament' => $currTournament,
            'signed' => $signedTeams
        ]);
    }
}
