<?php

namespace Dufa\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManager;
use Dufa\Bundle\CoreBundle\Entity\Rewards;

class Reward
{
    private $em;

    private $logger;

    private $commentType;



    public function __construct(EntityManager $entityManager, $commentType,$logger)
    {
        $this->em = $entityManager;
        $this->commentType = $commentType;
        $this->logger = $logger;
    }

    public function reward($type,$user,$money,$id, $contents)
    {
        try
        {
            $method = "generate".ucfirst($type);
            $obj = $this->$method($id);
            $obj
                ->setContents($contents)
                ->setUser($user)
                ->setMoney($money)
                ->setType($type);
            $this->em->persist($obj);
            $this->em->flush($obj);
            return $obj;
        }
        catch (\Exception $e)
        {
            $this->logger->error('<error>$e->getMessage()</error>');
            return false;
        }
    }

    protected function generateDefault($id)
    {
        $comment = new Rewards();
        return $comment;
    }
    protected function generateDictionay($id)
    {
        $dictionayInfo = $this->em->getRepository('DufaCoreBundle:Dictionay')->find($id);
        $comment = new Rewards();
        $comment->setDId($dictionayInfo);
        return $comment;
    }

    protected function generateCreative($id)
    {
        $creativeInfo = $this->em->getRepository('DufaCoreBundle:Creatives')->find($id);
        $comment = new Rewards();
        $comment->setCreativeId($creativeInfo);
        return $comment;
    }

    protected function generateAnswer($id)
    {
        $answer = $this->em->getRepository("DufaCoreBundle:AskQuestionsAnswer")->find($id);
        $comment = new Rewards();
        $comment->setAqaId($answer);
        $comment->setAqId($answer->getAqId());
        return $comment;
    }

}
