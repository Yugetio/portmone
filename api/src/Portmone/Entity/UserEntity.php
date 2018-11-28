<?php

namespace App\Portmone\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class UserEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;


    /**
     * @var DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;


    /**
     * @var DateTime $updated
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;


    /**
     * @ORM\OneToMany(targetEntity="App\Portmone\Entity\FolderEntity", mappedBy="userId")
     */
    private $folders;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        try {
            $dateTimeNow = new DateTime('now');
            $this->setUpdatedAt($dateTimeNow);
            if ($this->getCreatedAt() === null) {
                $this->setCreatedAt($dateTimeNow);
            }
        }
        catch (\Exception $e){
        }
    }

    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt() :?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection|FolderEntity[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }


    public function __construct(string $password, string $email)
    {
        $this->password = $password;
        $this->email = $email;

        $this->folders = new ArrayCollection();
    }

    public function serialize()
    {
        $serializedArray = [
            'password' => $this->password,
            'email' => $this->email,
        ];
        return $serializedArray;
    }

    static function deserialize(array $data)
    {
        $validator = Validation::createValidator();
        if (!isset($data['password'])) {
            throw new BadRequestHttpException('Password shouldn`t be empty.');
        }
        if (!isset($data['email'])) {
            throw new BadRequestHttpException('Email shouldn`t be empty.');
        }

        $userPasswordError = $validator->validate($data['password'], [
            new Assert\NotBlank(),
            new Assert\Length([
                'min' => 6,
                'max' => 32,
                'minMessage' => 'Your password must be at least {{ limit }} characters long',
                'maxMessage' => 'Your password cannot be longer than {{ limit }} characters'
            ]),
        ]);

        $userEmailError = $validator->validate($data['email'], [
            new Assert\NotBlank(),
            new Assert\Email([
                'message' => 'The email "{{ value }}" is not a valid email.',
            ])
        ]);

        $errors = [];
        if(count($userPasswordError) > 0) {
            $errors['$userPasswordError'] = $userPasswordError[0]->getMessage();
        }
        if(count($userEmailError) > 0) {
            $errors['$userEmailError'] = $userEmailError[0]->getMessage();
        }
        if($errors) {
            return $errors;
        }
        return new self(
            $data['password'],
            $data['email']
        );
    }


    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
          'ROLE_USER'
        ];
    }

}
