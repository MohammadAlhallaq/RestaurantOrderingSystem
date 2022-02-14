<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.partials.head')
</head>
<body data-theme-version="dark">
@include('layout.partials.header')
@include('layout.partials.nav-bar')
@yield('content')
@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
@yield('js')



<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
<script>
    $( document ).ready(function() {
        initFirebaseMessagingRegistration()
    });

    // const firebaseConfig = {
    //     apiKey: "AIzaSyDku8q5yuFDuu38F5sLW0gKoQ2tiRJ9uVw",
    //     authDomain: "etechnocode.firebaseapp.com",
    //     projectId: "etechnocode",
    //     storageBucket: "etechnocode.appspot.com",
    //     messagingSenderId: "52246139816",
    //     appId: "1:52246139816:web:dd810413b1feef4020439d"
    // };

    const firebaseConfig = {
        apiKey: "AIzaSyDwmUHNVttXqCk3zcrPfzoFxqzkNwvrqy0",
        authDomain: "hashtagneed-1618659090595.firebaseapp.com",
        projectId: "hashtagneed-1618659090595",
        storageBucket: "hashtagneed-1618659090595.appspot.com",
        messagingSenderId: "617580643052",
        appId: "1:617580643052:web:fc64b47364fc1de053dbc9",
        measurementId: "G-JWGZDRDHH8"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (token) {
                console.log(token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Notification enabled.');

                    },
                    error: function (err) {
                        console.log('User Chat Token Error' + err);
                    },
                });
            }).catch(function (err) {
            console.log('User Chat Token Error' + err);
        });
    }

    messaging.onMessage(function (payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>

</body>
</html>
