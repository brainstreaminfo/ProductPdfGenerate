<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('productpdfgenerate::app.catalog.products.index.product-pdf')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse; 
            margin-bottom: 5px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            vertical-align: top; 
        }
        th {
            background-color: #f2f2f2;
        }
        .product-image {
            max-width: 140px;
            height: 140px; 
            display: block;
            margin: 0 auto; 
        }
        p.product-name {
            word-wrap: break-word;
            max-width: 120px;
            margin: 5px auto;
            text-align: center;
        }
        td {
            width: 33.33%; /* Each product takes up one-third of the row */
            height: 250px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>@lang('productpdfgenerate::app.catalog.products.index.product-list')</h1>
        <table>
            <tbody>
                @foreach($products as $index => $product)
                    @if ($index % 3 === 0)
                        <tr>
                    @endif
                    <td>
                        <div>
                            @php
                                $image = $product->images->first();
                            @endphp

                            @if($image && Storage::disk('public')->exists($image->path))
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(Storage::disk('public')->path($image->path))) }}" alt="Product Image" class="product-image"/>
                            @endif
                        </div>
                        <p class="product-name">{{ $product->name }}</p>
                        <p><strong>@lang('productpdfgenerate::app.catalog.products.index.sku')</strong> {{ $product->sku }}</p>
                        <p><strong>@lang('productpdfgenerate::app.catalog.products.index.price')</strong> ${{ number_format($product->price, 2) }}</p>
                    </td>
                    @if ($index % 3 === 2)
                        </tr>
                    @endif
                @endforeach

                @if ($products->count() % 3 !== 0)
                    @for ($i = 0; $i < (3 - ($products->count() % 3)); $i++)
                        <td></td>
                    @endfor
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
