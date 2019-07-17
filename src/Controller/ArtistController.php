<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PictureUploader;

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

    /**
     * @Route("/new", name="artist_new", methods={"GET","POST"})
     */
    public function new(Request $request, PictureUploader $pictureUploader): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form['picture']->getData();
            if ($pictureFile) {
                $pictureFileName = $pictureUploader->upload($pictureFile);
                $artist->setPicture($pictureFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();
            $this->addFlash('success', "L'artiste a bien été créé.");

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'artistForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="artist_edit", methods={"GET","POST"})
     */
    public function editArtist(Request $request, Artist $artist,
                               PictureUploader $pictureUploader,
                               Filesystem $filesystem): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form['picture']->getData();

            if (!empty($pictureFile) || empty($pictureFile)) {
                $filesystem->remove($this->getParameter('photos_directory') . '/' . $artist->getPicture());
                $pictureName = $pictureUploader->upload($pictureFile);
                $artist->setPicture($pictureName);
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "L'artiste a bien été modifié.");

            return $this->redirectToRoute('artist_index', [
                'id' => $artist->getId(),
            ]);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'artistForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="artist_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artist);
            $entityManager->flush();
            $this->addFlash('danger', "L'artiste a bien été supprimé.");
        }

        return $this->redirectToRoute('artist_index');
    }
}
