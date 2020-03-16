<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9723cf728b0e630d4750', {
        cluster: 'eu',
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('newReservation', function(data) {
        var audio = new Audio('{{url("public/admin/sounds/alarm.ogg")}}');
        audio.play();
        makeToast(data.message,2);
    });
</script>