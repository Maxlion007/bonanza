<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 12:54
 */

namespace core\services\manage\User;


use core\entities\Meta;
use core\entities\User\Model\Category;
use core\forms\manage\User\Model\CategoryForm;
use core\repositories\ProductRepository;
use core\repositories\User\CategoryRepository;

class CategoryManageService
{
    private $categories;
    private $products;
    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }
    public function create(CategoryForm $form)
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->price,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }
    public function edit($id, CategoryForm $form)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->price,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }
    public function moveUp($id)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }
    public function moveDown($id)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }
    public function remove($id)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existsByMainCategory($category->id)) {
            throw new \DomainException('Unable to remove category with products.');
        }
        $this->categories->remove($category);
    }
    private function assertIsNotRoot(Category $category)
    {
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}