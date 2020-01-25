<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Tournament;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class TeamController extends AbstractController
{

    /**
     * @Route("/", name="team_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $tournaments = $entityManager->getRepository(Tournament::class)->findBy(array(), array('begin' => 'DESC'));
        if($tournaments == null)
        {
            return $this->render('team/error.html.twig', array('error' => 'Aktuell steht kein Turnier an!'));
        }
        if($tournaments[0]->getMaxPlayers() <= count($tournaments[0]->getTeams()))
        {
            return $this->render('team/error.html.twig', array('error' => 'Maximale Spieleranzahl erreicht!'));
        }
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $team->setTournament($tournaments[0]);
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('team_success', array('id' => $team->getId()));
        }

        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
            'tournaments' => $tournaments,
        ]);
    }

    /**
     * @Route("/admin/team/{id}/edit", name="team_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Team $team): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/success/{id}", name="team_success", methods={"GET"})
     */
    public function success(Team $team)
    {
        return $this->render('team/success.html.twig', array(
            'team' => $team,
        ));
    }

    /**
     * @Route("/admin/team/{id}", name="team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Team $team): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('team_index');
    }
}
