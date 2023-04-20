/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import $ from "jquery";
window.$ = $;
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

import Echo from "laravel-echo";
window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ":" + window.laravel_echo_port,
});

let i = 0;
window.Echo.channel("user-channel").listen(".UsersEvent", (data) => {
    i++;
    $("#message-line").after(
        `
        <div class="flex flex-row justify-between mt-3">
            <div class="flex flex-row">
                <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                <div class="flex flex-col">
                    <div class="font-bold">${data.data[0].user_name}</div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="text-sm">${data.data[0].message.message}</div>
                <div class="text-sm text-end">${convertDate(
                    data.data[0].message.created_at
                )}</div>
            </div>
        </div>
        `
    );
});

const convertDate = (isoDate) => {
    const date = new Date(isoDate);

    const formattedDate = date
        .toLocaleString("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        })
        .replace(",", "");
    return formattedDate;
};

window.Echo.private("user." + window.Laravel.user).listen(
    ".UserPrivateEvent",
    (e) => {
        console.log('ssss');
        console.log(window.Laravel.user);
        console.log(e);
    }
);
