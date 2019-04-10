<?php

namespace App\Command;

use App\Converter\FormatConverter;
use App\Entity\User;
use App\Entity\UserResult;
use App\Factory\EntityFactory;
use App\Service\ArrayDivider\ICanDivideArray;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArrayDivideCommand extends Command
{
    protected static $defaultName = 'app:array-divide';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ICanDivideArray
     */
    private $service;

    public function __construct($name = null, EntityManagerInterface $em, ICanDivideArray $service)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->service = $service;
    }

    protected function configure()
    {
        $this
            ->setDescription('Array divider')
            ->addArgument('needle', InputArgument::REQUIRED, 'Needle of array i.e. "3"')
            ->addArgument('haystack', InputArgument::REQUIRED, 'Array to divide i.e. "1,3,3"')
            ->addArgument('user_email', InputArgument::OPTIONAL, 'User email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = null;
        $io = new SymfonyStyle($input, $output);
        $needle = $input->getArgument('needle');
        $haystackAsStr = $input->getArgument('haystack');
        $email = $input->getArgument('user_email');

        if ($needle) {
            $io->note(sprintf('You passed an needle: %s', $needle));
        }

        if ($haystackAsStr) {
            $io->note(sprintf('You passed an haystack: %s', $haystackAsStr));
        }

        if ($email) {
            $io->note(sprintf('Result will be linked with user: %s', $email));
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        }

        $result = $this->service->divide((int)$needle, FormatConverter::stringHaystackToArray($haystackAsStr));
        if ($user) {
            $userResult = EntityFactory::makeUsersResult($user, $needle, $haystackAsStr, $result);
            $this->em->getRepository(UserResult::class)->storeResult($userResult);
        }

        $io->success($result);
    }
}
