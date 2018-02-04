<?php

namespace App\Entity;

interface EventInterface
{
    public function getCreatedAt();

    public function getEventImage();

    public function getEventTitle();
}
