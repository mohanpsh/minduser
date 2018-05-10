<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 *
 */

namespace Tests\AppBundle\Database;

use AppBundle\Database\Manager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class ManagerTest
 * @package Tests\AppBundle\Database
 */
class ManagerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Manager
     */
    private $dbM;

    public function setUp()
    {
        $this->client = $this->makeClient();
        $this->dbM = $this->client ->getContainer()->get('app.database.manager');
        parent::setUp();
    }

    public function testRepositories()
    {
        //test user repository
        $this->assertInstanceOf(EntityRepository::class, $this->dbM->repository()->user());
    }

    public function testEntities()
    {
        //test user entity
        $this->assertInstanceOf(User::class, $this->dbM->entity()->user());
    }

    public function testEntityManager()
    {
        //test user entity
        $this->assertInstanceOf(EntityManager::class, $this->dbM->entityManager());
    }
}
