const filesToCache = [
    '/css/app.css',
    '/js/utiltop.js',
    '/js/utildown.js',
    '/js/list.js',
    '/time.svg',
    '/register.svg',
    '/password.svg',
    '/login.svg',
    '/link.svg',
    '/forget.svg',
    '/favicon.ico',
    '/icon-192x192.png',
    '/icon-256x256.png',
    '/icon-384x384.png',
    '/icon-512x512.png',
    '/offline.html'
];

const preLoad = async () => {
    return caches.open('offline').then((cache) => {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener('install', (event) => {
    event.waitUntil(preLoad());
});

const checkResponse = (request) => {
    return new Promise((fulfill, reject) => {
        fetch(request).then((response) => {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = async (request) => {
    return caches.open('offline').then(async (cache) => {
        return fetch(request).then((response) => {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = async (request) => {
    return caches.open('offline').then(async (cache) => {
        return cache.match(request).then((matching) => {
            if (!matching || matching.status === 404) {
                return cache.match('offline.html');
            }

            return matching;
        });
    });
};

self.addEventListener('fetch', (event) => {
    event.respondWith(checkResponse(event.request).catch(() => {
        return returnFromCache(event.request);
    }));

    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
});