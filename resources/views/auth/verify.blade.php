@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifier votre adresse email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien de verification a été envoyé vers votre adresse email.') }}
                        </div>
                    @endif

                    {{ __('Avant procéder, SVP voir le lien dans votre boite mail.') }}
                    {{ __('Si vous n avez pas reçu votre email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquer ici pour envoyer un autre ') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
