<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 03/12/18
 * Time: 10:48
 */

namespace App\Controller;

use App\Entity\TimeTravel;
use DateInterval;
use DatePeriod;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TimeTravelController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/", name="get_travel_info", methods="GET|POST")
     */
    public function getTravelInfo()
    {
        $timeTravel=new TimeTravel();
        $start=new \DateTimeImmutable('1985-12-31');
        $timeTravel->setStart($start);
        $interval=new DateInterval('PT1000000000S');
        $end=$timeTravel->findDate($interval);
        $timeTravel->setEnd($end);
        $sentenceInterval=$start->diff($end);
        $sentence=$sentenceInterval->format('Il y a %y années, %m mois, %d jours, %h heures, %i minutes et %s secondes entre les deux dates.');

        $step=new DateInterval('P1M8D');
        $datePeriod = new DatePeriod($timeTravel->getEnd(), $step, $start);
        $allDates=$timeTravel->backToFutureStepByStep($datePeriod);
        return $this->render('time_travel.html.twig', ['start' => $start, 'end' => $end, 'sentence' => $sentence, 'allDates' => $allDates]);
    }
}