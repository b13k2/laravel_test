<?php

declare(strict_types=1);

namespace App\Services;

use App\Dictionaries\DocumentType;
use App\Models\Document;
use App\Models\Product;
use ErrorException;
use Illuminate\Support\Facades\DB;
use Throwable;

class DocumentService
{
    /**
     * @param Document $document
     * @param array $products
     * @return void
     * @throws ErrorException
     * @throws Throwable
     */
    public function create(Document $document, array $products): void
    {
        DB::beginTransaction();

        $productIds = $products['product_id'];
        $productQuantities = $products['product_quantity'];

        $isArrival = $document->type_id == DocumentType::arrival;

        try {
            foreach ($productIds as $key => $productId) {
                $quantity = (int) $productQuantities[$key];
                $productQuantity = $this->getQuantityProductById((int) $productId);

                if ($isArrival) {
                    $newQuantity = $productQuantity + $quantity;
                } else {
                    $newQuantity = $productQuantity - $quantity;
                }

                if ($newQuantity < 0) {
                    throw new ErrorException('Недостаточно товара на складе');
                }

                DB::table('products')
                    ->where('id', '=', $productId)
                    ->update(['quantity' => $newQuantity]);

                $document->saveOrFail();
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return int
     * @throws ErrorException
     */
    public function getQuantityProductById(int $id): int
    {
        /** @var ?Product $product */
        $product = DB::table('products')
            ->where('id', '=', $id)
            ->lockForUpdate()
            ->first();

        if (!$product) {
            throw new ErrorException('Товар не найден');
        }

        return $product->quantity;
    }
}
