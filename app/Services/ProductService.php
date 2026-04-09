<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct()
    {
        //
    }
    public function createProduct(array $data, User $user)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            if ($image->isValid()) {
                $imageName = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $imageName, 'public');
                $data['image'] = $imageName;
            } else {
                unset($data['image']);
            }
        } else {
            unset($data['image']);
        }

        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(Str::random(5));
        }
        $data['created_by'] = $user->id;
        return Product::create($data);
    }
    public function updateProduct(array $data, Product $product)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            if ($image->isValid()) {
                $imageName = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $imageName, 'public');
                $data['image'] = $imageName;
            } else {
                unset($data['image']);
            }
        } else {
            unset($data['image']);
        }
        return $product->update($data);
    }
    public function deleteProduct(Product $product){
        return $product->delete();
    }
}
?>