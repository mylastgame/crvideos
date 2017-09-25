<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.09.17
 * Time: 20:06
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="number")
 */
class Number
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="`integer`", type="integer")
     * @var
     */
    protected $integer;

    /**
     * @ORM\Column(type="decimal", scale=3, precision=8)
     * @var
     */
    protected $number;

    /**
     * @ORM\Column(name="`float`", type="decimal", scale=3, precision=8)
     * @var
     */
    protected $float;

    /**
     * @ORM\Column(type="integer")
     * @var
     */
    protected $rangeValue;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @param mixed $integer
     */
    public function setInteger($integer)
    {
        $this->integer = $integer;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * @param mixed $float
     */
    public function setFloat($float)
    {
        $this->float = $float;
    }

    /**
     * @return mixed
     */
    public function getRangeValue()
    {
        return $this->rangeValue;
    }

    /**
     * @param mixed $rangeValue
     */
    public function setRangeValue($rangeValue)
    {
        $this->rangeValue = $rangeValue;
    }


}