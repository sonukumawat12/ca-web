<?php

namespace App\Traits;

trait BlogCategoryTrait
{
    /**
     * Get all available blog categories
     *
     * @return array
     */
    public static function getCategories(): array
    {
        return [
            'Income Tax',
            'GST',
            'Accounting',
            'Audit',
            'Company Law',
            'Finance',
            'Investment Planning',
            'Compliance',
            'TDS & TCS',
            'Budget & Tax Updates'
        ];
    }
}
