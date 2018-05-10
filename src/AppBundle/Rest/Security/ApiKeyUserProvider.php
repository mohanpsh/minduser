<?php

namespace AppBundle\Rest\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use AppBundle\Database\Manager as DatabaseManager;
use AppBundle\Entity\User as UserModel;

/**
 * Class ApiKeyUserProvider
 * @package AppBundle\Security
 */
class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var DatabaseManager
     */
    private $dbM;

    /**
     * ApiKeyUserProvider constructor.
     * @param DatabaseManager $dbM
     */
    public function __construct(DatabaseManager $dbM)
    {
        $this->dbM = $dbM;
    }

    /**
     * @param string $apiKey
     * @return UserModel|null
     */
    public function getUserForApiKey($apiKey)
    {
        $user = $this->dbM->repository()->user()->findOneBy(['apiKey' => $apiKey, 'enabled' => 1]);
        return $user instanceof UserModel ? $user : null;
    }

    /**
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            array('ROLE_API')
        );
    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     */
    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
