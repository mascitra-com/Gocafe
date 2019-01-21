@extends('_layout/dashboard/index')
@section('page_title', 'Verifikasi Email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mohon Verifikasi Email Anda</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Link Baru untuk Verifikasi Email sudah terkirim.
                        </div>
                    @endif
                        Sebelum melanjutkan, mohon cek email Anda untuk verifikasi.
                        Jika belum menerima, <a href="{{ route('verification.resend') }}">klik disini</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
