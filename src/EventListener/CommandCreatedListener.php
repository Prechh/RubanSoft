<?php

namespace App\EventListener;

use App\Entity\Commande;
use App\Entity\Article;
use App\Event\CommandeCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostPersistEventArgs;

class CommandCreatedListener
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function postPersist(PostPersistEventArgs $args)
  {
    $entity = $args->getObject();

    // Vérifiez si l'objet est une instance de Commande
    if (!$entity instanceof Commande) {
      return;
    }

    $article = $entity->getArticles();
    $quantity = $entity->getQuantity();

    // Vérifiez si la quantité de la commande est supérieure au stock de l'article
    if ($quantity > $article->getStock()) {
      throw new \Exception("La quantité de la commande est supérieure au stock disponible.");
    }


    $article->setStock($article->getStock() - $quantity);

    $this->entityManager->persist($article);
    $this->entityManager->flush();
  }

  public function onCommandCreated(CommandeCreatedEvent $event)
  {
    $commande = $event->getCommand();

    $this->postPersist($commande);
  }
}
