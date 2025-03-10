<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    /**
     * Récupère les cours vus par un utilisateur donné via la table intermédiaire 'user_course'
     */
    public function findCoursesByUser(User $user): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT c.* FROM course c
            INNER JOIN user_course uc ON c.id = uc.course_id
            WHERE uc.user_id = :userId
        ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['userId' => $user->getId()]);

        return $resultSet->fetchAllAssociative();
    }
}
