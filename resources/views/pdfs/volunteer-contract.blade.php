<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Volunteer Contract - {{ $contract->agreement->topic }}</title>
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
            border-bottom: 2px solid #3b82f6;
        }

        .header h1 {
            font-size: 20px;
            color: #3b82f6;
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
            color: #3b82f6;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .info-box.gray {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
        }

        .info-box.green {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
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
            background-color: #3b82f6;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }

        .volunteer-notice {
            background-color: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 12px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .volunteer-notice p {
            margin: 0;
            font-size: 10px;
            color: #1e40af;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>VOLUNTEER AGREEMENT</h1>
        <h2 style="font-size: 16px; color: #1f2937; margin: 5px 0;">{{ strtoupper($contract->agreement->topic) }}</h2>
        <p>Contract Reference: CR-{{ str_pad($contract->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p>Generated on: {{ now()->format('F d, Y \a\t h:i A') }}</p>
        <p><span class="status-badge">✓ SIGNED & ACCEPTED</span></p>
    </div>

    <div class="section">
        <div class="section-title">Event Information</div>
        <div class="info-box">
            <div class="info-row"><strong>Event Name:</strong> <span>{{ $event->name }}</span></div>
            <div class="info-row"><strong>Category:</strong> <span>{{ $event->category->name ?? 'N/A' }}</span></div>
            <div class="info-row"><strong>Event Date:</strong> <span>{{ $event->starts_at->format('F d, Y') }} - {{ $event->ends_at->format('F d, Y') }}</span></div>
            <div class="info-row"><strong>Location:</strong> <span>{{ $event->city ?? 'N/A' }}</span></div>
            <div class="info-row"><strong>Contract Signed:</strong> <span>{{ $contract->signed_at->format('F d, Y \a\t h:i A') }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Organization / Event Organizer</div>
        <div class="info-box green">
            <div class="info-row"><strong>Organization:</strong> <span>{{ $organization }}</span></div>
            <div class="info-row"><strong>Contact Person:</strong> <span>{{ $contract->requester->name }}</span></div>
            <div class="info-row"><strong>Email:</strong> <span>{{ $email }}</span></div>
            <div class="info-row"><strong>Phone:</strong> <span>{{ $contact }}</span></div>
            <div class="info-row"><strong>Address:</strong> <span>{{ $address }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Volunteer Information</div>
        <div class="info-box">
            <div class="info-row"><strong>Name:</strong> <span>{{ $volunteerData['name'] }}</span></div>
            <div class="info-row"><strong>Email:</strong> <span>{{ $volunteerData['email'] }}</span></div>
            <div class="info-row"><strong>Phone:</strong> <span>{{ $volunteerData['phone'] }}</span></div>
            <div class="info-row"><strong>Address:</strong> <span>{{ $volunteerData['address'] }}</span></div>
        </div>
        <div class="volunteer-notice">
            <p>✓ I acknowledge that I have read, understood, and agree to abide by all the terms and conditions outlined in this volunteer agreement.</p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Terms & Conditions</div>
        <div class="terms">{{ $terms }}</div>
    </div>

    <div class="signature-section">
        <div class="section-title">Legal Verification & Signature</div>
        <div class="signature-box">
            @if($signatureUrl)
            <img src="{{ public_path('storage/' . $contract->signature_path) }}" alt="Lawyer Signature">
            @else
            <p style="padding: 20px 0; font-weight: bold;">Digitally Verified</p>
            @endif
            <p>
                <strong>Verified by:</strong> {{ $contract->lawyer->name ?? 'Legal Representative' }}<br>
                <strong>Date:</strong> {{ $contract->signed_at->format('F d, Y \a\t h:i A') }}<br>
                <strong style="color: #10b981;">✓ This agreement has been legally verified and is binding</strong>
            </p>
        </div>
        <div class="info-box gray" style="margin-top: 20px;">
            <div class="info-row"><strong>Volunteer:</strong> <span>{{ $volunteerData['name'] }}</span></div>
            <div class="info-row"><strong>Accepted on:</strong> <span>{{ $contract->signed_at->format('F d, Y \a\t h:i A') }}</span></div>
            <div class="info-row"><strong>Status:</strong> <span style="color: #3b82f6; font-weight: bold;">Accepted & Agreed</span></div>
        </div>
    </div>

    <div class="footer">
        <p>This is an electronically generated volunteer agreement. Digital acceptance is legally binding.</p>
        <p>Contract ID: CR-{{ str_pad($contract->id, 6, '0', STR_PAD_LEFT) }} | Generated: {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>

</html>