<?php

namespace App\Entity;

/**
 * EventInterface
 */
interface EventInterface
{
    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @return mixed
     */
    public function getEventImage();

    /**
     * @return mixed
     */
    public function getEventTitle();
}
