<?php


namespace App\Controller;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/artist")
 *
 */

class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index")
     */

    public function index(): Response
    {
        $artists = $this->getDoctrine()
            ->getManager()
            ->getRepository(Artist::class)
            ->findAll();

        return $this->render(
            'artist/index.html.twig',
            [
                'artists' => $artists
            ]
        );
    }
}