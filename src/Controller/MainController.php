<?php

namespace App\Controller;

use App\Model\WeatherModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    private $requestStack;
    private $widget;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->widget = $this->get_widget_data();
    }

    /**
     * Affiche la page d'accueil
     * 
     * @return Response
     * 
     * @Route("/", name="main_home")
     */
    public function home(): Response
    {
        $data = WeatherModel::getWeatherData();
        return $this->render('main/index.html.twig', [
            'cities_list' => $data,
            'widget' => $this->widget
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
            'widget' => $this->widget
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
            'widget' => $this->widget
        ]);
    }

    /**
     * retourne  informations d'une ville donnée pour le widget
     *
     * @param SessionInterface $session
     * @return array
     */
    public function get_widget_data(): array
    {
        // on récupère le theme de la session
        $session = $this->requestStack->getSession();
        $city_id = $session->get('city');
        $city_array = WeatherModel::getWeatherByCityIndex($city_id);
        return $city_array;
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
     * @Route("/set_city/{id}", name="main_set_city", requirements={"id"="\d+"})
     */
    public function set_city(SessionInterface $session, int $id): Response
    {
        // on récupère le theme de la session
        $city = $session->set('city', $id);

        // on redirige vers la home
        return $this->redirectToRoute('main_home');
    }
}
