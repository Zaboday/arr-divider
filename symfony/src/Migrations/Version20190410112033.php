<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Version\Version;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Создание пользователя-админа
 */
final class Version20190410112033 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var string
     */
    private $adminEmail = 'admin@admin.com';

    /**
     * @var string
     */
    private $adminPassword = 'adminpass';

    public function __construct(Version $version)
    {
        parent::__construct($version);
    }

    /**
     * Получаем доступ к doctrine.orm.entity_manager и security.user_password_encoder.generic
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->em = $container->get('doctrine.orm.entity_manager');
        $this->encoder = $container->get('app.service.user_password_encoder');
    }

    public function getDescription(): string
    {
        return 'Create Admin User <' . $this->adminEmail . '>';
    }

    public function up(Schema $schema): void
    {
        $user = new User();
        $user->setEmail($this->adminEmail);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setApiToken('111');

        $plainPassword = $this->adminPassword;
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $user = $this->em->getRepository(User::class)->findBy(['email' => $this->adminEmail]);
        if ($user) {
            $this->em->remove($user);
            $this->em->flush();
        }
    }
}
