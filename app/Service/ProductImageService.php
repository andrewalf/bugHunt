<?php

namespace App\Service;

/**
 * Этот класс менять нельзя.
 */
final class ProductImageService
{
    /**
     * @throws \Exception
     */
    public function getRandomImageUrl()
    {
        // вероятность 1 процент
        // Дима, этот код убирать НЕЛЬЗЯ.
        // Это имитация проблем со сторонним сервисом, который ты используешь,
        // но контролировать не можешь
        if (rand(1, 100) <= 1) {
            throw new \Exception('Request to something unexpectedly failed');
        }

        return 'https://placehold.co/250';
    }
}