<?php

namespace Webkul\ProductPdfGenerate\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Webkul\Product\Models\Product;
use PDF;

class ProductController extends Controller
{
    public function generatePdf()
    {
        $products = Product::all();

        $pdf = PDF::loadView('productpdfgenerate::catalog.products.pdf', compact('products'));

        return $pdf->download('Products-Catalogue.pdf');
    }
}
