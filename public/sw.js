const preLoad = function () {
    return caches.open('offline').then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener('install', function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    '/css/app.css',
    '/js/dashboard.js',
    '/404.svg',
    '/link.svg',
    '/favicon.ico',
    '/icon-192x192.png',
    '/icon-256x256.png',
    '/icon-384x384.png',
    '/icon-512x512.png',
    '/offline.html'
];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    return caches.open('offline').then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = function (request) {
    return caches.open('offline').then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match('offline.html');
            }

            return matching;
        });
    });
};

self.addEventListener('fetch', function (event) {
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));

    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
});
