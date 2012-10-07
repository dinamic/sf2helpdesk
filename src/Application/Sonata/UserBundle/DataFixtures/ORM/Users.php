<?php

namespace Jat\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Application\Sonata\UserBundle\Entity\User;

class Users
    extends AbstractFixture
    implements OrderedFixtureInterface,
               FixtureInterface,
               ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $groupGuests    = $this->getReference('group-guests');
        $groupStaff     = $this->getReference('group-staff');
        $groupEditors   = $this->getReference('group-editors');
        $groupAdmins    = $this->getReference('group-admins');
        $groupUsers     = $this->getReference('group-users');
        $groupGods      = $this->getReference('group-gods');

        $users = array(
            array(
                'username'  => 'guest01',
                'password'  => 'guest01',
                'email'     => 'guest01@test.com',
                'roles'     => $groupGuests->getRoles(),
                'group'     => $groupGuests
            ),
            array(
                'username'  => 'staff01',
                'password'  => 'staff01',
                'email'     => 'staff01@test.com',
                'roles'     => $groupStaff->getRoles(),
                'group'     => $groupStaff
            ),
            array(
                'username'  => 'editor01',
                'password'  => 'editor01',
                'email'     => 'editor01@test.com',
                'roles'     => $groupEditors->getRoles(),
                'group'     => $groupEditors
            ),
            array(
                'username'  => 'admin01',
                'password'  => 'admin01',
                'email'     => 'admin01@test.com',
                'roles'     => $groupAdmins->getRoles(),
                'group'     => $groupAdmins
            ),
            array(
                'username'  => 'user01',
                'password'  => 'user01',
                'email'     => 'user01@test.com',
                'roles'     => $groupUsers->getRoles(),
                'group'     => $groupUsers
            ),
            array(
                'username'  => 'user02',
                'password'  => 'user02',
                'email'     => 'user02@test.com',
                'roles'     => $groupUsers->getRoles(),
                'group'     => $groupUsers
            ),

            array(
                'username'  => 'user03',
                'password'  => 'user03',
                'email'     => 'user03@test.com',
                'roles'     => $groupUsers->getRoles(),
                'group'     => $groupUsers
            ),
            array(
                'username'  => 'user04',
                'password'  => 'user04',
                'email'     => 'user04@test.com',
                'roles'     => $groupUsers->getRoles(),
                'group'     => $groupUsers
            ),
            array(
                'username'  => 'user05',
                'password'  => 'user05',
                'email'     => 'user05@test.com',
                'roles'     => $groupUsers->getRoles(),
                'group'     => $groupUsers
            ),
            array(
                'username'  => 'god01',
                'password'  => 'god01',
                'email'     => 'god01@test.com',
                'roles'     => $groupGods->getRoles(),
                'group'     => $groupGods
            ),
            array(
                'username'  => 'jat_dev',
                'password'  => 'jat_dev',
                'email'     => 'jatval@gmail.com',
                'roles'     => $groupGods->getRoles(),
                'group'     => $groupGods
            ),
        );

        foreach ($users as $user) {
            $entity = new User();
            $entity->setUsername($user['username']);

            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($entity);
            $entity->setPassword(
                $encoder->encodePassword(
                    $user['password'],
                    $entity->getSalt()
                )
            );
            $entity->setEmail($user['email']);
            $entity->setRoles($user['roles']);
            $entity->addGroup($user['group']);
            $entity->setEnabled(true);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}