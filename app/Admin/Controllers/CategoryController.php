<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $type      = $request->get('type');
        $keyword   = $request->get('keyword');

        $categories = Category::where('parent_id', $parent_id)
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })->when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->orderBy('sort', 'asc')->paginate();

        $categoriesJson = Category::treeJson();

        return view('Admin::categories.index', compact('categories', 'categoriesJson'));
    }

    public function create()
    {
        return view('Admin::categories.create');
    }

    public function store(CategoryRequest $request)
    {
        if (Category::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Category $category)
    {
        return view('Admin::categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if ($category->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
