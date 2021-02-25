<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Form\Form;

/**
* @ORM\Entity
* @ORM\Table(name="person")
* @ORM\Entity(repositoryClass="Admin\Entity\Repository\PersonRepository")
*/
class Person
{
  /**
   * @ORM\Id
   * @ORM\Column(name="id", type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
   protected $id;

   /**
   * @ORM\Column(name="name", type="string")
   */
   protected $name;

   /**
   * @ORM\Column(name="email", type="string")
   */
   protected $email;

   /**
   * @ORM\Column(name="password", type="string")
   */
   protected $password;

   /**
   * @ORM\Column(name="created_at", type="datetime")
   */
   protected $createdAt;

   /**
   * @ORM\Column(name="updated_at", type="datetime")
   */
   protected $updatedAt;


   public function __construct($options = null){
       Configurator::configure($this, $options);
   }

   public function toArray(){
       return array(
             'id' => $this->getId(),
             'name' => $this->getName(),
             'email' => $this->getEmail()
       );
   }

   public function toTable(){
       $dados = $this->toArray();
       return $dados;
   }

   public function toForm(){
       $dados = $this->toArray();
       return $dados;
   }

   public function getId()
   {
	    return $this->id;
   }

   public function setId($id)
   {
	    $this->id = $id;
   }

   public function getName()
   {
	    return $this->name;
   }

   public function setName($name)
   {
	    $this->name = $name;
   }

   public function getEmail()
   {
	    return $this->email;
   }

   public function setEmail($email)
   {
	    $this->email = $email;
   }

   public function getPassword()
   {
	    return $this->password;
   }

   public function setPassword($password)
   {
	    $this->password = $password;
   }

   public function getCreatedAt()
   {
	    return $this->createdAt;
   }

   public function setCreatedAt($createdAt)
   {
	    $this->createdAt = $createdAt;
   }

   public function getUpdatedAt()
   {
	    return $this->updatedAt;
   }

   public function setUpdatedAt($updatedAt)
   {
	    $this->updatedAt = $updatedAt;
   }

}
?>