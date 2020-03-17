<?php
//
namespace App\Service;

use App\Entity\Parameter\Parameter as EntityParameter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Parameter
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function get(String $keyIndex){

        $parameter = $this->em->getRepository(EntityParameter::class)->findOneBy(["keyIndex" => $keyIndex]);
        
        if(!empty($parameter)){
            return $parameter->getValue();
        }

        return "";
    }

    public function set(String $keyIndex, String $value){

        $parameter = $this->em->getRepository(EntityParameter::class)->findOneBy(["keyIndex" => $keyIndex]);
        
        if(!empty($parameter)){
            $parameter->setValue($value);
        } else {
            $parameter = new EntityParameter();
            $parameter->setKeyIndex($keyIndex);
            $parameter->setValue($value);
            $this->em->persist($parameter);
            
        }

    }

}