<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 03/12/18
 * Time: 10:39
 */

namespace App\Entity;

use DateInterval;
use DatePeriod;

class TimeTravel
{
    /**
     * @var \DateTimeImmutable
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @return \DateTimeImmutable
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTimeImmutable $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function findDate(DateInterval $interval)
    {
        $start=$this->getStart();
        $end=$start->sub($interval);
        return $end;
    }

    public function backToFutureStepByStep(DatePeriod $step)
    {
        $allDates=[];
        foreach ($step as $key => $date) {
            $number=$key+1;
            $allDates[]='Step '.$number.' : '.$date->format('M d Y \P\M h:i');
        }
        return $allDates;
    }
}