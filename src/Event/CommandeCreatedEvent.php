<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class CommandeCreatedEvent extends Event
{
  private $command;

  public function __construct($command)
  {
    $this->command = $command;
  }

  public function getCommand()
  {
    return $this->command;
  }
}
