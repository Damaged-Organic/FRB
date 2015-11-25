<?php
// src/AppBundle/Model/Comment.php
namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Comment
{
    /**
     * @Assert\NotBlank(
     *      message="comment.name.not_blank"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "comment.company.length.min",
     *      maxMessage = "comment.company.length.max"
     * )
     */
    protected $company;

    /**
     * @Assert\NotBlank(
     *      message="comment.email.not_blank"
     * )
     * @Assert\Email(
     *      message="comment.email.valid"
     * )
     */
    protected $email;

    /**
     * @Assert\NotBlank(
     *      message = "comment.comment.not_blank"
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 1500,
     *      minMessage = "comment.comment.length.min",
     *      maxMessage = "comment.comment.length.max"
     * )
     */
    protected $comment;

    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }
}