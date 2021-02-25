<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Form\Form;

/**
* @ORM\Entity
* @ORM\Table(name="jobs")
* @ORM\Entity(repositoryClass="Admin\Entity\Repository\JobRepository")
*/
class Job
{
  /**
   * @ORM\Id
   * @ORM\Column(name="id", type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
   protected $id;

   /**
   * @ORM\ManyToOne(targetEntity="Admin\Entity\Person")
   * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
   */
   protected $personId;

   /**
   * @ORM\Column(name="title", type="string")
   */
   protected $title;

   /**
   * @ORM\Column(name="description", type="string")
   */
   protected $description;

   /**
   * @ORM\Column(name="status", type="boolean")
   */
   protected $status;

   /**
   * @ORM\Column(name="workplace", type="string")
   */
   protected $workplace;

   /**
   * @ORM\Column(name="salary", type="decimal")
   */
   protected $salary;

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
             'title' => $this->getTitle(),
             'description' => $this->getDescription(),
             'status' => $this->getStatus(),
             'workplace' => $this->getWorkplace(),
             'salary' => (float) $this->getSalary()
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

   public function getPersonId()
   {
	    return $this->personId;
   }

   public function setPersonId($personId)
   {
	    $this->personId = $personId;
   }

   public function getTitle()
   {
	    return $this->title;
   }

   public function setTitle($title)
   {
	    $this->title = $title;
   }

   public function getDescription()
   {
	    return $this->description;
   }

   public function setDescription($description)
   {
	    $this->description = $description;
   }

   public function getStatus()
   {
	    return $this->status;
   }

   public function setStatus($status)
   {
	    $this->status = $status;
   }

   public function getWorkplace()
   {
	    return $this->workplace;
   }

   public function setWorkplace($workplace)
   {
	    $this->workplace = $workplace;
   }

   public function getSalary()
   {
	    return $this->salary;
   }

   public function setSalary($salary)
   {
	    $this->salary = $salary;
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