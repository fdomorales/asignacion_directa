@extends('layouts.app')

@section('breadcrumb')
    <div class="content">
        <nav class="migas">
            <a href="/">Inicio / </a>
            <span class="active">Validar email</span>
        </nav>
    </div>
@endsection

@section('contenido')
    <div class="col-12 mb-4">
        <div class="sombra borde bg-white p-4 mb-4 mt-4">
            <div class="row">
                <h4>Verificar email</h4>

                <p class="text-justify">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                <p class="text-justify">Integer dui nisi, sollicitudin vel dolor sed, tempus tempus urna. Nulla tortor arcu, tincidunt malesuada sem at, tristique maximus risus. Etiam accumsan eget eros ac placerat. Cras id metus vitae ante sagittis dapibus. Ut fermentum faucibus purus accumsan aliquam. In non nulla dignissim, sagittis ante vel, pulvinar metus. In faucibus lacus non elit rutrum, nec volutpat lorem ornare. Morbi vitae est neque. Curabitur molestie nulla id ornare fermentum. Cras at mollis sapien. Suspendisse commodo ex vitae porttitor convallis. Cras at sapien sit amet lorem sollicitudin tempus. Aliquam erat volutpat. Curabitur sagittis viverra augue ac placerat.</p>

                <p class="text-justify">Nunc ac ultricies lacus. Donec sed venenatis nulla. Donec imperdiet gravida lacus in facilisis. Aliquam id tortor nibh. Sed ultricies sem id lacus vulputate, in eleifend arcu fringilla. Donec volutpat urna vel mi sodales malesuada. Sed eget urna eu leo aliquet vestibulum eget non diam. Mauris porttitor justo magna, sit amet rutrum nisl suscipit condimentum. Vivamus lacinia magna vel faucibus fermentum. Nam tempor tincidunt malesuada. Donec sed augue ut nibh commodo cursus vitae sit amet erat. Maecenas finibus lacus vitae consequat aliquam. Phasellus in sem ac turpis suscipit ultrices non ac dolor. Suspendisse eget diam eu nibh interdum iaculis. In vestibulum at enim sed fermentum. Praesent a commodo nisi.</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <div class="btn-group">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div>
                                <button class="btn btn-azul">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="btn-group">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-verde">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
