<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Tournament;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api/v1")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/all", name="api_all")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(Tournament::class)->findAll();
        $result = array();
        foreach ($data as $d)
        {
            array_push($result, $d->getId());
        }
        return new Response(json_encode($result));
    }

    /**
     * @Route("/{id}", name="api_detail")
     */
    public function tournaments(Tournament $tournament)
    {
        return new Response(
            $this->getSerializer()
                ->serialize(
                    array(
                        'timestamp' => $tournament->getBegin()->format('U'),
                        'teams' => $tournament->getTeams()
                    ), 'json',  [AbstractNormalizer::IGNORED_ATTRIBUTES => ['tournament']]
                )
        );
    }

    private function getSerializer()
    {
        $encoders = [new JsonEncoder()];
        $normaliter = [new ObjectNormalizer()];
        $serializer = new Serializer($normaliter, $encoders);

        return $serializer;
    }
}
