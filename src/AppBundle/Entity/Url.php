<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Url
 *
 * @ORM\Table(name="url")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UrlRepository")
 */
class Url
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255, unique=true)
     */
    private $uri;

    /**
     * @var int
     *
     * @ORM\Column(name="count_jumps", type="integer", options={"default" : 0})
     */
    private $countJumps;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return Url
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set countJumps
     *
     * @param integer $countJumps
     * @return Url
     */
    public function setCountJumps($countJumps)
    {
        $this->countJumps = $countJumps;

        return $this;
    }

    /**
     * Increase countJumps
     *
     * @param integer $countJumps
     * @return Url
     */
    public function increasCountJumps()
    {
        $this->countJumps ++;

        return $this;
    }

    /**
     * Get countJumps
     *
     * @return integer
     */
    public function getCountJumps()
    {
        return $this->countJumps;
    }
}
