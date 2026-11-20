<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegisterProcessor implements ProcessorInterface
{

    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $processor,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): User
    {

        if (!$data->getPlainPassword()) 
            return $this->processor->process($data, $operation, $uriVariables, $context);
        
        $hashedPassword = $this->passwordHasher->hashPassword(
            $data,
            $data->getPlainPassword()
        );

        $data->setPassword($hashedPassword);

        
        // To avoid leaving sensitive data like the plain password in memory or logs, we manually clear it after hashing.
        $data->setPlainPassword(null);

        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}
