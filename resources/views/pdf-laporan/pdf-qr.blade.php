@extends('layouts/pdf/main')

@section('content')
    <div class="card bg-white text-center shadow" style="text-align: center;">
        <div class="card-header">
            <span class="text-danger" style="color: red; margin-bottom: 100px;">*Jangan berikan QrCode ini pada pihak
                manapun.</span>
            <div class="card-body">
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size('300')->generate($qr_token)) }}"
                    alt="" style="margin-top: 100px;">
            </div>
        </div>
    </div>
@endsection
