var CACHE_NAME = 'my-site-cache-v3';
var urlsToCache = [
  'public/notika/js/vendor/jquery-1.12.4.min.js',
  'public/notika/js/bootstrap.min.js',
  'public/notika/js/wow.min.js',
  'public/notika/js/jquery-price-slider.js',
  'public/notika/js/owl.carousel.min.js',
  'public/notika/js/jquery.scrollUp.min.js',
  'public/notika/js/meanmenu/jquery.meanmenu.js',
  'public/notika/js/counterup/jquery.counterup.min.js',
  'public/notika/js/counterup/waypoints.min.js',
  'public/notika/js/counterup/counterup-active.js',
  'public/notika/js/scrollbar/jquery.mCustomScrollbar.concat.min.js',
  'public/notika/js/jvectormap/jquery-jvectormap-2.0.2.min.js',
  'public/notika/js/jvectormap/jquery-jvectormap-world-mill-en.js',
  'public/notika/js/jvectormap/jvectormap-active.js',
  'public/notika/js/sparkline/jquery.sparkline.min.js',
  'public/notika/js/sparkline/sparkline-active.js',
  'public/notika/js/flot/jquery.flot.js',
  'public/notika/js/flot/jquery.flot.resize.js',
  'public/notika/js/flot/curvedLines.js',
  'public/notika/js/knob/jquery.knob.js',
  'public/notika/js/knob/jquery.appear.js',
  'public/notika/js/knob/knob-active.js',
  'public/notika/js/wave/waves.min.js',
  'public/notika/js/wave/wave-active.js',
  'public/notika/js/todo/jquery.todo.js',
  'public/notika/js/plugins.js',
  'public/notika/js/chat/moment.min.js',
  'public/notika/js/chat/jquery.chat.js',
  'public/notika/js/main.js',
  'public/notika/js/tawk-chat.js'
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request)
        .then(function(response) {
          // Cache hit - return response
          if (response) {
            return response;
          }
          return fetch(event.request);
        }
      )
    );
  });


  self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request)
        .then(function(response) {
          // Cache hit - return response
          if (response) {
            return response;
          }
  
          // IMPORTANT: Clone the request. A request is a stream and
          // can only be consumed once. Since we are consuming this
          // once by cache and once by the browser for fetch, we need
          // to clone the response.
          var fetchRequest = event.request.clone();
  
          return fetch(fetchRequest).then(
            function(response) {
              // Check if we received a valid response
              if(!response || response.status !== 200 || response.type !== 'basic') {
                return response;
              }
  
              // IMPORTANT: Clone the response. A response is a stream
              // and because we want the browser to consume the response
              // as well as the cache consuming the response, we need
              // to clone it so we have two streams.
              var responseToCache = response.clone();
  
              caches.open(CACHE_NAME)
                .then(function(cache) {
                  cache.put(event.request, responseToCache);
                });
  
              return response;
            }
          );
        })
      );
  });