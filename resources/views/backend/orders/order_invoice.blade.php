<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice - EasyShop</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            position: relative;
        }

        /* REMOVED the problematic SVG background that was causing the error */
        .invoice-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            opacity: 0.3;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 1;
        }

        .company-info h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .company-info p {
            opacity: 0.9;
            font-size: 1.1em;
        }

        .contact-info {
            text-align: right;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .contact-info p {
            margin-bottom: 5px;
            font-size: 0.95em;
        }

        .invoice-details {
            padding: 30px;
            background: #f8f9ff;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .customer-info, .invoice-info {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .customer-info h3, .invoice-info h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.2em;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: 600;
            min-width: 100px;
            color: #555;
        }

        .info-value {
            color: #333;
        }

        .invoice-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #667eea;
        }

        .products-section {
            padding: 0 30px 30px;
        }

        .products-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .products-title::before {
            content: 'Products: ';
            margin-right: 10px;
            font-size: 1.2em;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .products-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .products-table th {
            padding: 15px 10px;
            text-align: center;
            font-weight: 600;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .products-table tbody tr {
            background: white;
            transition: background-color 0.3s ease;
        }

        .products-table tbody tr:nth-child(even) {
            background: #f8f9ff;
        }

        .products-table tbody tr:hover {
            background: #e8ebff;
        }

        .products-table td {
            padding: 15px 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: cover;
            border: 2px solid #eee;
        }

        .totals-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
            padding: 30px;
            text-align: right;
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .total-label {
            margin-right: 20px;
            min-width: 100px;
        }

        .total-value {
            font-weight: bold;
            color: #667eea;
            min-width: 120px;
        }

        .grand-total {
            font-size: 1.5em;
            padding-top: 15px;
            border-top: 2px solid #667eea;
            margin-top: 15px;
        }

        .footer {
            padding: 30px;
            text-align: center;
            background: white;
        }

        .thanks-message {
            font-size: 1.3em;
            color: #667eea;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .signature-box {
            text-align: center;
            min-width: 200px;
        }

        .signature-line {
            border-top: 2px solid #333;
            margin-bottom: 10px;
        }

        .signature-label {
            color: #667eea;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
            }

            .contact-info {
                text-align: left;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .products-table {
                font-size: 0.8em;
            }

            .products-table th,
            .products-table td {
                padding: 8px 5px;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="company-info">
                    <h1>EasyShop</h1>
                    <p>Premium Quality Products</p>
                </div>
                <div class="contact-info">
                    <p><strong>EasyShop Head Office</strong></p>
                    <p>Email: support@easylearningbd.com</p>
                    <p>Phone: 1245454545</p>
                    <p>Address: Dhaka 1207, Dhanmondi #4</p>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div class="details-grid">
                <div class="customer-info">
                    <h3>Bill To</h3>
                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $order->name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $order->email ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $order->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ $order->division->division_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Post Code:</span>
                        <span class="info-value">{{ $order->post_code ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="invoice-info">
                    <h3>Invoice Details</h3>
                    <div class="info-row">
                        <span class="info-label">Invoice #:</span>
                        <span class="info-value invoice-number">{{ $order->invoice_no ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Order Date:</span>
                        <span class="info-value">{{ $order->order_date ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Delivery:</span>
                        <span class="info-value">{{ $order->delivered_date ?? 'Pending' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Payment:</span>
                        <span class="info-value">{{ $order->payment_method ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="products-section">
            <h2 class="products-title">Order Items</h2>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Code</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orderItem && $orderItem->count() > 0)
                        @foreach($orderItem as $item)
                        <tr>
                            <td>
                                @if(isset($item->product->product_thumbnail))
                                    <img src="{{ public_path($item->product->product_thumbnail) }}" alt="Product" class="product-image">
                                @else
                                    <div class="product-image" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">No Image</div>
                                @endif
                            </td>
                            <td>{{ $item->product->product_name_en ?? 'N/A' }}</td>
                            <td>
                                @if($item->size == NULL)
                                    ----
                                @else
                                    {{ $item->size }}
                                @endif
                            </td>
                            <td>{{ $item->color ?? 'N/A' }}</td>
                            <td>{{ $item->product->product_code ?? 'N/A' }}</td>
                            <td>{{ $item->qty ?? 0 }}</td>
                            <td>${{ $item->price ?? 0 }}</td>
                            <td>${{ ($item->price ?? 0) * ($item->qty ?? 0) }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No items found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals-section">
            <div class="total-row">
                <span class="total-label">Subtotal:</span>
                <span class="total-value">${{ $order->amount ?? 0 }}</span>
            </div>
            <div class="total-row">
                <span class="total-label">Tax (5%):</span>
                <span class="total-value">${{ number_format(($order->amount ?? 0) * 0.05, 2) }}</span>
            </div>
            <div class="total-row">
                <span class="total-label">Shipping:</span>
                <span class="total-value">$0.00</span>
            </div>
            <div class="total-row grand-total">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">${{ $order->amount ?? 0 }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="thanks-message">
                Thank you for choosing EasyShop! We appreciate your business.
            </div>

            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">Authorized Signature</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
