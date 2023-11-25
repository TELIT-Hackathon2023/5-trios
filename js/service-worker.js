// service-worker.js

// Define a unique cache name
const cacheName = 'shortly-web-app-cache-v1';

// List the files you want to cache
const filesToCache = [
    '/',
    '/index.php',
    '/style/home.css',
    '/style/header.css',
    '/style/global.css',
    '/style/login.css',
    '/style/register.css',
    '/js/burger.js',
    '/js/toast.js',
    '/js/qr-generator.js',
    '/media/favicon.ico'
    // Add other files and assets you want to cache
];

// Install event: cache the static assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(cacheName)
            .then((cache) => {
                return cache.addAll(filesToCache);
            })
            .then(() => {
                return self.skipWaiting();
            })
    );
});

// Activate event: clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys()
            .then((cacheNames) => {
                return Promise.all(
                    cacheNames.filter((name) => {
                        return name !== cacheName;
                    }).map((name) => {
                        return caches.delete(name);
                    })
                );
            })
            .then(() => {
                return self.clients.claim();
            })
    );
});

// Fetch event: serve from cache if available, otherwise make a network request
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                return response || fetch(event.request);
            })
    );
});
