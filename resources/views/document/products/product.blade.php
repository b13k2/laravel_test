@php
    declare(strict_types=1);

    use App\Models\DocumentProduct;
    use App\Models\Product;

    /**
     * @var DocumentProduct $model
     */

    $input = 'documentProduct.forms.inputs';
@endphp

<x-dynamic-component
    :component='"$input.select"'
    :model='$model'
    :attrs='$attrs'
    attrName='product_id'
    :options='Product::all()'
    placeholder='-- выберите товар --'
    labelAttr='name'
    required
/>

<x-dynamic-component
    :component='"$input.string"'
    :model='$model'
    :attrs='$attrs'
    attrName='product_quantity'
    required
/>
