<?php

namespace Dufa\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManager;
use Dufa\Bundle\CoreBundle\Entity\Informs;

class Inform
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

    public function inform($type,$user, $id, $contents)
    {
        try
        {
            $method = "generate".ucfirst($type);
            $obj = $this->$method($id);
            $obj
                ->setContents($contents)
                ->setUser($user)
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
        $comment = new Informs();
        return $comment;
    }
    protected function generateDictionay($id)
    {
        $dictionayInfo = $this->em->getRepository('DufaCoreBundle:Dictionay')->find($id);
        $comment = new Comments();
        $comment->setDId($dictionayInfo);
        return $comment;
    }

    protected function generateCreative($id)
    {
        $creativeInfo = $this->em->getRepository('DufaCoreBundle:Creatives')->find($id);
        $comment = new Informs();
        $comment->setCreativeId($creativeInfo);
        return $comment;
    }

    protected function generateAnswer($id)
    {
        $answer = $this->em->getRepository("DufaCoreBundle:AskQuestionsAnswer")->find($id);
        $comment = new Informs();
        $comment->setAqaId($answer);
        $comment->setAqId($answer->getAqId());
        return $comment;
    }

}
