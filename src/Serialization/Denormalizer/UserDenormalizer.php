<?php
declare(strict_types=1);

namespace App\Serialization\Denormalizer;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class UserDenormalizer implements \Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface, \Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    const ALREADY_CALLED = 'USER_DENORMALIZER_ALREADY_CALLED';
    private UserPasswordHasherInterface $passwordHash;
    private Security $security;

    public function __construct(UserPasswordHasherInterface $passwordHash, Security $security)
    {
        $this->passwordHash = $passwordHash;
        $this->security = $security;
    }
    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        if (!isset($context[self::ALREADY_CALLED]) && $type == User::class){
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $context[self::ALREADY_CALLED] = true;
        if(isset($data['password'])) {
            $data['password'] = $this->passwordHash->hashPassword($this->security->getUser(), $data['password']);
        }
        return $this->denormalize($data, $type, $format, $context);
    }
 }