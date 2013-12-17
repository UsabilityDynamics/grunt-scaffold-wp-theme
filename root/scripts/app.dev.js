/**
 * Application Loader
 *
 */
function Bootstrap( jQuery, async ) {
  
  // All events, functionality should be added here
  
}

require.config({
  "paths": {
    "async": "//cdnjs.cloudflare.com/ajax/libs/async/0.2.7/async.min",
    "html5shiv": "//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js",
    "jquery.form": "//cdn.jsdelivr.net/jquery.form/3.36/jquery.form.min",
    "bootstrap": "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min",
    "knockout": "//ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1",
    "lodash": "//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.2.1/lodash.min",
    "backbone": "//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min",
    "jquery": "//codeorigin.jquery.com/jquery-2.0.3"
  },
  "shim": {
    "bootstrap": {
      "deps": [ "jquery" ]
    },
    "backbone": {
      "deps": [ "jquery", "lodash" ],
      "exports": "Backbone"
    },
    "lodash": {
      "exports": "_"
    },
    "knockout": {
      "exports": "knockout"
    }
  },
  "uglify": {
    "beautify": true,
    "max_line_length": 1000,
    "no_mangle": true
  },
  "waitSeconds": 5
});

require( [ 'jquery', 'async', 'bootstrap' ], Bootstrap );

