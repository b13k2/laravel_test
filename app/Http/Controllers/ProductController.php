<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Forms\ProductForm;
use App\Http\Search\ProductSearch;
use App\Models\Product;
use App\Traits\Controllers\ActiveFilterTrait;
use App\Traits\Controllers\ActiveSortTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Throwable;

class ProductController extends Controller
{
    use ActiveSortTrait,
        ActiveFilterTrait;

    /**
     * @param ProductSearch $request
     * @return View
     */
    public function index(ProductSearch $request): View
    {
        $query = Product::query();

        if (!$this->applySort($query)) {
            $query->orderByDesc('id');
        }

        $this->applyFilter($query, 'id', 'int');
        $this->applyFilter($query, 'name', 'string');
        $this->applyFilter($query, 'vendor_code', 'string');

        return view('product.index', [
            'models' => $query->paginate(10),
            'attrs' => $request->attributes(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('product.create', [
            'model' => Product::query()->make(),
            'attrs' => (new ProductForm())->attributes(),
        ]);
    }

    /**
     * @param ProductForm $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(ProductForm $request): RedirectResponse
    {
        $product = Product::query()->make($request->validated());
        $product->saveOrFail();

        return redirect()
            ->action([get_class($this), 'index'])
            ->with('success', 'Товар успешно добавлен');
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('product.edit', [
            'model' => $product,
            'attrs' => (new ProductForm())->attributes(),
        ]);
    }

    /**
     * @param ProductForm $request
     * @param Product $product
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(ProductForm $request, Product $product): RedirectResponse
    {
        $product->fill($request->validated());
        $product->saveOrFail();

        return redirect()
            ->action([get_class($this), 'index'])
            ->with('success', 'Товар успешно отредактирован');
    }

    /**
     * @param Product $product
     * @return void
     * @throws Throwable
     */
    public function destroy(Product $product): void
    {
        $product->deleteOrFail();
    }
}
