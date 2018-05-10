<?php

namespace AppBundle\Rest\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use AppBundle\Rest\Error\Manager as ErrorManager;

/**
 * Class ApiKeyAuthenticator
 * @package AppBundle\Security
 */
class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    /**
     * @var ErrorManager
     */
    private $errorManager;

    /**
     * @var \AppBundle\Rest\Error\Model\Response
     */
    private $errorResponse;

    /**
     * @var string
     */
    private $format;

    /**
     * ApiKeyAuthenticator constructor.
     * @param ErrorManager $errorManager
     */
    public function __construct(ErrorManager $errorManager)
    {
        $this->errorManager = $errorManager;
        $this->errorResponse = $this->errorManager->errorResponse();
    }

    /**
     * @param Request $request
     * @param string $providerKey
     * @throws BadCredentialsException
     * @return null|PreAuthenticatedToken
     */
    public function createToken(Request $request, $providerKey)
    {
        //first check if the api_rest_ name is in route and we are responsible for this request
        if(stripos($request->attributes->get('_route'), 'api_rest_') === false){
            return null;
        }

        $this->format = $request->attributes->get('_format', 'json');

        // now check the credentials in header
        $username = $request->headers->get('username');
        $apiKey = $request->headers->get('apiKey');
        if (!$username) {
            $error = $this->errorManager->error();
            $error->setCode(400);
            $error->setMessage('username not found in header!');
            $this->errorResponse->addError($error);
        }

        if (!$apiKey) {
            $error = $this->errorManager->error();
            $error->setCode(400);
            $error->setMessage('apiKey not found in header!');
            $this->errorResponse->addError($error);
        }

        if($this->errorResponse->hasErrors()){
            throw new BadCredentialsException('apiKey or username not found!');
        }

        return new PreAuthenticatedToken(
            $username,
            $apiKey,
            $providerKey
        );
    }

    /**
     * @param TokenInterface $token
     * @param $providerKey
     * @throws CustomUserMessageAuthenticationException
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @throws BadCredentialsException
     * @return PreAuthenticatedToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof ApiKeyUserProvider) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of ApiKeyUserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        $apiKey = $token->getCredentials();
        $userModel = $userProvider->getUserForApiKey($apiKey);

        if (!$userModel) {
            $error = $this->errorManager->error();
            $error->setCode(401);
            $error->setMessage('apiKey or username not valid!');
            $this->errorResponse->addError($error);
            throw new BadCredentialsException('apiKey or username not valid!');
        }

        if($token->getUsername() != $userModel->getUsername()){
            $error = $this->errorManager->error();
            $error->setCode(401);
            $error->setMessage('apiKey or username not valid!');
            $this->errorResponse->addError($error);
            throw new BadCredentialsException('apiKey or username not valid!');
        }

        return new PreAuthenticatedToken(
            $userModel,
            $apiKey,
            $providerKey,
            $userModel->getRoles()
        );
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $this->errorResponse->setCode(401);
        if($this->format == 'xml'){
            return $this->errorManager->xmlResponse($this->errorResponse);
        }
        return $this->errorManager->jsonResponse($this->errorResponse);
    }
}
