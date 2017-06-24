<?php

namespace Dufa\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManager;

class AdoptAnwer
{
    private $em;

    private $logger;

    public function __construct(EntityManager $entityManager,$logger)
    {
        $this->em = $entityManager;
        $this->logger = $logger;
    }

    /**
     * 最佳答案
     */
    public function best($anwerId)
    {
        $anwerInfo = $this->em->getRepository("DufaCoreBundle:AskQuestionsAnswer")->find($anwerId);
        $anwerInfo->setBest(true);
        $this->em->persist($anwerInfo);
        $this->em->flush();
        return $anwerInfo;
    }

    /**
     * 普通答案
     */
    public function general($anwerId)
    {
        $anwerInfo = $this->em->getRepository("DufaCoreBundle:AskQuestionsAnswer")->find($anwerId);
        $anwerInfo->setGeneral(true);
        $this->em->persist($anwerInfo);
        $this->em->flush();
        return $anwerInfo;
    }
}
