<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contract - {{ $contract->agreement->topic }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #333;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #10b981;
        }

        .header h1 {
            font-size: 20px;
            color: #10b981;
            margin: 0 0 10px 0;
        }

        .header p {
            font-size: 10px;
            color: #666;
            margin: 5px 0;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .info-box.gray {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-row strong {
            display: inline-block;
            width: 140px;
            color: #374151;
        }

        .info-row span {
            color: #1f2937;
        }

        .terms {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 4px;
            white-space: pre-wrap;
            font-size: 10px;
            line-height: 1.5;
        }

        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 15px;
            text-align: center;
            border-radius: 4px;
            min-height: 80px;
        }

        .signature-box img {
            max-height: 60px;
            max-width: 200px;
            margin: 10px auto;
            display: block;
        }

        .signature-box p {
            font-size: 9px;
            color: #666;
            margin-top: 8px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #999;
        }

        .status-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ strtoupper($contract->agreement->topic) }}</h1>
        <p>Contract Reference: CR-{{ str_pad($contract->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p>Generated on: {{ now()->format('F d, Y \a\t h:i A') }}</p>
        <p><span class="status-badge">✓ SIGNED & EXECUTED</span></p>
    </div>

    <!-- Contract Information -->
    <div class="section">
        <div class="section-title">Contract Information</div>
        <div class="info-box">
            <div class="info-row">
                <strong>Event:</strong>
                <span>{{ $contract->event->name }}</span>
            </div>
            <div class="info-row">
                <strong>Event Date:</strong>
                <span>{{ $contract->event->starts_at->format('F d, Y') }} - {{ $contract->event->ends_at->format('F d, Y') }}</span>
            </div>
            <div class="info-row">
                <strong>Contract Signed:</strong>
                <span>{{ $contract->signed_at->format('F d, Y \a\t h:i A') }}</span>
            </div>
            <div class="info-row">
                <strong>Status:</strong>
                <span style="color: #10b981; font-weight: bold;">Approved & Signed</span>
            </div>
        </div>
    </div>

    <!-- Organization Details -->
    <div class="section">
        <div class="section-title">Organization / Requester Details</div>
        <div class="info-box">
            <div class="info-row">
                <strong>Organization:</strong>
                <span>{{ $organization }}</span>
            </div>
            <div class="info-row">
                <strong>Contact Person:</strong>
                <span>{{ $contract->requester->name }}</span>
            </div>
            <div class="info-row">
                <strong>Email:</strong>
                <span>{{ $email }}</span>
            </div>
            <div class="info-row">
                <strong>Phone:</strong>
                <span>{{ $contact }}</span>
            </div>
            <div class="info-row">
                <strong>Address:</strong>
                <span>{{ $address }}</span>
            </div>
        </div>
    </div>

    <!-- Legal Representative -->
    <div class="section">
        <div class="section-title">Legal Representative</div>
        <div class="info-box gray">
            <div class="info-row">
                <strong>Lawyer:</strong>
                <span>{{ $lawyer->name }}</span>
            </div>
            <div class="info-row">
                <strong>Email:</strong>
                <span>{{ $lawyer->email }}</span>
            </div>
            <div class="info-row">
                <strong>Signed Date:</strong>
                <span>{{ $contract->signed_at->format('F d, Y \a\t h:i A') }}</span>
            </div>
        </div>
    </div>

    <!-- Contract Terms & Conditions -->
    <div class="section">
        <div class="section-title">Terms & Conditions</div>
        <div class="terms">{{ $terms }}</div>
    </div>

    <!-- Digital Signature -->
    <div class="signature-section">
        <div class="section-title">Digital Signature</div>
        <div class="signature-box">
            @if($signatureUrl)
            <img src="{{ public_path('storage/' . $contract->signature_path) }}" alt="Signature">
            @else
            <p style="padding: 20px 0; font-weight: bold;">Digitally Signed</p>
            @endif
            <p>
                <strong>Signed by:</strong> {{ $lawyer->name }}<br>
                <strong>Date:</strong> {{ $contract->signed_at->format('F d, Y \a\t h:i A') }}<br>
                <strong style="color: #10b981;">✓ This document has been digitally signed and is legally binding</strong>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>This is an electronically generated contract. No physical signature is required.</p>
        <p>Contract ID: CR-{{ str_pad($contract->id, 6, '0', STR_PAD_LEFT) }} | Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>

</html>