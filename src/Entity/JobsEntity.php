<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JobsEntity
 *
 * @ORM\Table(name="jobs", indexes={@ORM\Index(name="ix_jobs_company_id", columns={"company_id"}), @ORM\Index(name="ix_jobs_date_published", columns={"date_published"}), @ORM\Index(name="ix_jobs_division_id", columns={"division_id"}), @ORM\Index(name="ix_jobs_profession_id", columns={"profession_id"}), @ORM\Index(name="ix_jobs_role_id", columns={"role_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\JobsRepository")
 */
class JobsEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=false)
     */
    private $job;

    /**
     * @var string|null
     *
     * @ORM\Column(name="job_ref", type="string", length=255, nullable=true)
     */
    private $jobRef;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=2000, nullable=false)
     */
    private $link;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_published", type="date", nullable=true)
     */
    private $datePublished;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refkey", type="string", length=32, nullable=true, options={"fixed"=true})
     */
    private $refkey;

    /**
     * @var CompaniesEntity
     *
     * @ORM\ManyToOne(targetEntity="CompaniesEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var DivisionsEntity
     *
     * @ORM\ManyToOne(targetEntity="DivisionsEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     * })
     */
    private $division;

    /**
     * @var ProfessionsEntity
     *
     * @ORM\ManyToOne(targetEntity="ProfessionsEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profession_id", referencedColumnName="id")
     * })
     */
    private $profession;

    /**
     * @var RolesEntity
     *
     * @ORM\ManyToOne(targetEntity="RolesEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getJob(): string
    {
        return $this->job;
    }

    /**
     * @param string $job
     */
    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    /**
     * @return string|null
     */
    public function getJobRef(): ?string
    {
        return $this->jobRef;
    }

    /**
     * @param string|null $jobRef
     */
    public function setJobRef(?string $jobRef): void
    {
        $this->jobRef = $jobRef;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatePublished(): ?\DateTime
    {
        return $this->datePublished;
    }

    /**
     * @param \DateTime|null $datePublished
     */
    public function setDatePublished(?\DateTime $datePublished): void
    {
        $this->datePublished = $datePublished;
    }

    /**
     * @return string|null
     */
    public function getRefkey(): ?string
    {
        return $this->refkey;
    }

    /**
     * @param string|null $refkey
     */
    public function setRefkey(?string $refkey): void
    {
        $this->refkey = $refkey;
    }

    /**
     * @return CompaniesEntity
     */
    public function getCompany(): CompaniesEntity
    {
        return $this->company;
    }

    /**
     * @param CompaniesEntity $company
     */
    public function setCompany(CompaniesEntity $company): void
    {
        $this->company = $company;
    }

    /**
     * @return DivisionsEntity
     */
    public function getDivision(): DivisionsEntity
    {
        return $this->division;
    }

    /**
     * @param DivisionsEntity $division
     */
    public function setDivision(DivisionsEntity $division): void
    {
        $this->division = $division;
    }

    /**
     * @return ProfessionsEntity
     */
    public function getProfession(): ProfessionsEntity
    {
        return $this->profession;
    }

    /**
     * @param ProfessionsEntity $profession
     */
    public function setProfession(ProfessionsEntity $profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return RolesEntity
     */
    public function getRole(): RolesEntity
    {
        return $this->role;
    }

    /**
     * @param RolesEntity $role
     */
    public function setRole(RolesEntity $role): void
    {
        $this->role = $role;
    }
}
