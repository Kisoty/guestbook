<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Conference;
use Symfony\Component\String\Slugger\SluggerInterface;

class ConferenceEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Conference $conference)
    {
        $conference->generateSlug($this->slugger);
    }

    public function preUpdate(Conference $conference)
    {
        $conference->generateSlug($this->slugger);
    }
}
