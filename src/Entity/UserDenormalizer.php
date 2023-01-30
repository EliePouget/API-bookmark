<?php
declare(strict_types=1);

namespace App\Entity;

use ContainerDbGqXSx\getSecurity_Command_UserPasswordHashService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class UserDenormalizer implements \Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface, \Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface
{
    const ALREADY_CALLED = 'USER_DENORMALIZER_ALREADY_CALLED';
    private UserPasswordHasher $passwordHash;
    private Security $security;

    public function __construct(UserPasswordHasher $passwordHash, Security $security)
    {
        $this->passwordHash = $passwordHash;
        $this->security = $security;
    }
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        $res = false;
        if (!$context[self::ALREADY_CALLED] && $type == "User"){
            $res = true;
        }
        return $res;
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {

        $context[self::ALREADY_CALLED] = true;
        if($data){
            $this->passwordHash->hashPassword($this->security->getUser(), $data);
        }
        return $this->setDenormalizer();
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {
        // TODO: Implement setDenormalizer() method.
    }
}