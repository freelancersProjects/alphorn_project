<?php
namespace App\Enum;

enum CourseBlockType: string {
    case TEXT = 'text';
    case IMAGE = 'image';
    case VIDEO = 'video';
    case QUIZ = 'quiz';
}
