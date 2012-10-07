<?php

namespace Jat\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Application\Sonata\UserBundle\Entity\Group;

class Groups
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
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        $groups = array(
            array(
                'name'      => 'guests',
                'roles'     => array(
                    'ROLE_SONATA_ADMIN',
                    'ROLE_SONATA_USER_ADMIN_USER_VIEW',
                    'ROLE_SONATA_USER_ADMIN_USER_LIST',
                    'ROLE_SONATA_USER_ADMIN_GROUP_VIEW',
                    'ROLE_SONATA_USER_ADMIN_GROUP_LIST',
                ),
                'reference' => 'group-guests'
            ),
            array(
                'name'      => 'staff',
                'roles'     => array(
                    'ROLE_SONATA_ADMIN',
                    'ROLE_SONATA_USER_ADMIN_USER_EDIT',
                    'ROLE_SONATA_USER_ADMIN_USER_LIST',
                    'ROLE_SONATA_USER_ADMIN_USER_CREATE',
                    'ROLE_SONATA_USER_ADMIN_USER_VIEW',
                    'ROLE_SONATA_USER_ADMIN_USER_DELETE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_EDIT',
                    'ROLE_SONATA_USER_ADMIN_GROUP_LIST',
                    'ROLE_SONATA_USER_ADMIN_GROUP_CREATE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_VIEW',
                    'ROLE_SONATA_USER_ADMIN_GROUP_DELETE',
                ),
                'reference' => 'group-staff'
            ),
            array(
                'name'      => 'editors',
                'roles'     => array(
                    'ROLE_SONATA_ADMIN',
                    'ROLE_SONATA_USER_ADMIN_USER_EDIT',
                    'ROLE_SONATA_USER_ADMIN_USER_LIST',
                    'ROLE_SONATA_USER_ADMIN_USER_CREATE',
                    'ROLE_SONATA_USER_ADMIN_USER_VIEW',
                    'ROLE_SONATA_USER_ADMIN_USER_DELETE',
                    'ROLE_SONATA_USER_ADMIN_USER_EXPORT',
                    'ROLE_SONATA_USER_ADMIN_USER_OPERATOR',
                    'ROLE_SONATA_USER_ADMIN_GROUP_EDIT',
                    'ROLE_SONATA_USER_ADMIN_GROUP_LIST',
                    'ROLE_SONATA_USER_ADMIN_GROUP_CREATE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_VIEW',
                    'ROLE_SONATA_USER_ADMIN_GROUP_DELETE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_EXPORT',
                    'ROLE_SONATA_USER_ADMIN_GROUP_OPERATOR',
                ),
                'reference' => 'group-editors'
            ),
            array(
                'name'      => 'admins',
                'roles'     => array(
                    'ROLE_SONATA_USER_ADMIN_USER_EDIT',
                    'ROLE_SONATA_USER_ADMIN_USER_LIST',
                    'ROLE_SONATA_USER_ADMIN_USER_CREATE',
                    'ROLE_SONATA_USER_ADMIN_USER_VIEW',
                    'ROLE_SONATA_USER_ADMIN_USER_DELETE',
                    'ROLE_SONATA_USER_ADMIN_USER_EXPORT',
                    'ROLE_SONATA_USER_ADMIN_USER_OPERATOR',
                    'ROLE_SONATA_USER_ADMIN_USER_MASTER',
                    'ROLE_SONATA_USER_ADMIN_GROUP_EDIT',
                    'ROLE_SONATA_USER_ADMIN_GROUP_LIST',
                    'ROLE_SONATA_USER_ADMIN_GROUP_CREATE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_VIEW',
                    'ROLE_SONATA_USER_ADMIN_GROUP_DELETE',
                    'ROLE_SONATA_USER_ADMIN_GROUP_EXPORT',
                    'ROLE_SONATA_USER_ADMIN_GROUP_OPERATOR',
                    'ROLE_SONATA_USER_ADMIN_GROUP_MASTER',
                    'ROLE_ADMIN',
                ),
                'reference' => 'group-admins'
            ),
            array(
                'name'      => 'users',
                'roles'     => array(
                    'ROLE_USER',
                ),
                'reference' => 'group-users'
            ),
            array(
                'name'      => 'gods',
                'roles'     => array(
                    'ROLE_SUPER_ADMIN',
                ),
                'reference' => 'group-gods'
            ),
        );

        foreach ($groups as $group) {
            $name   = $group['name'];
            $roles  = $group['roles'];
            $entity = new Group($name, $roles);

            $manager->persist($entity);

            $this->addReference($group['reference'], $entity);
        }

        $manager->flush();
    }
}