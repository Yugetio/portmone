<?php
namespace App\Portmone\Entity;


use FOS\ElasticaBundle\Configuration\Search;

/**
 * @ORM\Table()
 * @Search(repositoryClass="App/Repository/Portmone/TokenEntityRepository")
 *
 */
class TokenEntity
{

}