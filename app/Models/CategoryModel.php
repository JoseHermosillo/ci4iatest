<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug', 'description'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name]',
        'slug' => 'required|min_length[3]|max_length[100]|is_unique[categories.slug]',
    ];
}
