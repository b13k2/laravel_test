<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Forms\DocumentForm;
use App\Http\Forms\DocumentProductForm;
use App\Http\Search\DocumentSearch;
use App\Models\Document;
use App\Models\DocumentProduct;
use App\Services\DocumentService;
use App\Traits\Controllers\ActiveFilterTrait;
use App\Traits\Controllers\ActiveSortTrait;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Throwable;

class DocumentController extends Controller
{
    use ActiveSortTrait,
        ActiveFilterTrait;

    /**
     * @param DocumentSearch $request
     * @return View
     */
    public function index(DocumentSearch $request): View
    {
        $query = Document::query();

        if (!$this->applySort($query)) {
            $query->orderByDesc('id');
        }

        $this->applyFilter($query, 'id', 'int');
        $this->applyFilter($query, 'date', 'date');
        $this->applyFilter($query, 'type_id', 'select');

        return view('document.index', [
            'models' => $query->paginate(10),
            'attrs' => $request->attributes(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        /** @var Document $document */
        $document = Document::query()->make();

        return view('document.create', [
            'model' => $document,
            'attrs' => (new DocumentForm())->attributes(),
            'productList' => $this->getProductList($document),
        ]);
    }

    /**
     * @param DocumentForm $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(DocumentForm $request): RedirectResponse
    {
        /** @var Document $document */
        $document = Document::query()->make($request->validated());

        if ($document->date === null) {
            $document->date = new DateTime();
        }

        $documentProductModel = new DocumentProduct();
        $productFormData = (array) $request->input($documentProductModel->formName(), []);

        $products = Validator::make($productFormData, (new DocumentProductForm())->rules())->validate();

        $documentService = new DocumentService();
        $documentService->create($document, $products);

        return redirect()
            ->action([get_class($this), 'index'])
            ->with('success', 'Документ успешно проведен');
    }

    /**
     * @param Document $document
     * @return View
     */
    public function edit(Document $document): View
    {
        return view('document.edit', [
            'model' => $document,
            'attrs' => (new DocumentForm())->attributes(),
            'productList' => $this->getProductList($document),
        ]);
    }

    /**
     * @param Document $document
     * @return string
     */
    private function getProductList(Document $document): string
    {
        $productTplName = "document.products.product";
        $productTpl = '';

        foreach ($document->products as $product) {
            $productTpl .= (view($productTplName, [
                'model' => $product,
                'attrs' => (new DocumentProductForm())->attributes(),
            ]))->render();
        }

        if (!$productTpl) {
            $productTpl = (view($productTplName, [
                'model' => new DocumentProduct(),
                'attrs' => (new DocumentProductForm())->attributes(),
            ]))->render();
        }

        return $productTpl;
    }
}
