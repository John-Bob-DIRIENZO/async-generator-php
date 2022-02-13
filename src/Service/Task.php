<?php

namespace App\Service;

use Generator;

class Task
{
    private Generator $generator;
    private bool $started = false;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function run()
    {
        if ($this->started) {
            $this->generator->next();
        } else {
            $this->generator->current();
            $this->started = true;
        }
    }

    public function finished(): bool
    {
        return !$this->generator->valid();
    }

    public function getReturn()
    {
        if ($this->finished()) {
            return $this->generator->getReturn();
        }
    }
}