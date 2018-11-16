@extends('layouts.app')

@section('content')
    <div class="container">
        <main>
            <p>Welcome to the push messaging codelab. The button below needs to be
                fixed to support subscribing to push.</p>
            <p>
                <button disabled class="js-push-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" onclick="initializeUI()">
                    Enable Push Messaging
                </button>
            </p>
            <section class="subscription-details js-subscription-details is-invisible">
                <pre><code class="js-subscription-json"></code></pre>
            </section>
        </main>
        <script type="text/javascript" src="js/test.js"></script>


        <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    </div>


@endsection