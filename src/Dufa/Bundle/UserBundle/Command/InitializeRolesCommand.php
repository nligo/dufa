<?php

namespace Dufa\Bundle\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeRolesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('dufa_user:initialize_roles')
            ->setDescription('Initialize the system Roles.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $param = [];
        $initializeRoles = $this->getContainer()->getParameter('initialize_roles');
        $output->writeln([
            'Is the operation...', // A line
            '============', // Another line
        ]);
        try {
            if (!empty($initializeRoles) && is_array($initializeRoles)) {
                foreach ($initializeRoles as $k => $v) {
                    $roleInfo = $this->getContainer()->get('dufa_user_manager.roles')->getRepository()->findOneBy(array('roleName' => 'ROLE_'.strtoupper($k)));
                    if (empty($roleInfo)) {
                        $param['roleName'] = $k;
                        $param['roleLabel'] = $v;
                        $roleInfo = $this->getContainer()->get('dufa_user_manager.roles')->create($param);
                        $output->writeln([
                            "{$roleInfo->getRoleName()} of initial success. ",
                        ]);
                    }
                    else
                    {
                        $output->writeln("{$roleInfo->getRoleName()} already exists, please do not repeat operation.");
                    }
                }
            }
        } catch (\Exception $e) {
            $output->writeln('error,'.$e->getMessage());
        }
    }
}
