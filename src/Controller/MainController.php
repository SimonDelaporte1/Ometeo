<?php

namespace App\Controller;

use WeatherModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * Affiche la page d'accueil
     * 
     * @return Response
     * 
     * @Route("/", name="main_home")
     */
    public function home(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    /**
     * 
     * Affiche la page météo des montagnes
     * 
     * @return Response
     * 
     * @Route("/mountain", name="main_mountain")
     */
    public function mountain(): Response
    {
        return $this->render('main/mountain.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * Affiche la page météo des plages
     * 
     * @return Response
     * 
     * @Route("/beach", name="main_beach")
     */
    public function beach(): Response
    {
        return $this->render('main/beach.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * enregistre une ville en session
     * 
     * @param SessionInterface $session
     * @param int $id
     * 
     * @return Response
     * 
     * @Route("/set_city", name="main_set_city", requirements={"id"="\d+"})
     */
    public function set_city(SessionInterface $session, int $id): Response
    {
        // on récupère le theme de la session
        $city = $session->set('city', $id);

        // on redirige vers la home
        return $this->redirectToRoute('main_home');
    }

    /**
     * retourne les informations d'une ville donnée
     *
     * @param SessionInterface $session
     * @return array
     */
    public function get_city(SessionInterface $session): array
    {
        // on récupère le theme de la session
        $city_id = $session->get('city');
        $city_array = WeatherModel::getWeatherByCityIndex($city_id);
        // on redirige vers la home
        return $city_array;
    }
}
