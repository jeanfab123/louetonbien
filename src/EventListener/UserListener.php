<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\User;

class UserListener
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            if (strlen($entity->getPassword() > 0)) {
                $entity->setPassword(
                    $this->encoder->encodePassword(
                        $entity,
                        $entity->getPassword()
                    )
                );
            }
        }
    }
}
