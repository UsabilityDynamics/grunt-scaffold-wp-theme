/*
 * Node.js Scaffolding Template
 *
 *
 * @todo After scaffolding, run "npm install" automatically.
 * @todo If GitHub repository given, attempt to create repository and commmit project after creation.
 * @todo If GitHub repository was created, create Wiki and set up as subdmodule in static/wiki.
 * 
 * @version 1.0.0
 */
var deepExtend = require( 'deep-extend' );
var options = {
  type: 'module'
};

exports.description = 'Create Wordpress Theme.';
exports.template = function(grunt, init, done) {

  var prompts = [
    init.prompt( 'title', 'My WP-Theme' ),
    init.prompt( 'name', 'my-wp-theme' ),
    init.prompt( 'slug', 'my_wp_theme_with_underscore' ),
    init.prompt( 'version', '1.0.0' ),
    init.prompt( 'description' ),
    init.prompt( 'repository', 'https://github.com/UsabilityDynamics/my-wp-theme' ),
    init.prompt( 'homepage', 'https://usabilitydynamics.com' ),
    init.prompt( 'author_name', 'UsabilityDynamics, Inc.' ),
    init.prompt( 'author_url', 'https://usabilitydynamics.com' ),
    
    init.prompt( 'github_vendor', 'usabilitydynamics' ),
    init.prompt( 'github_name', 'wp-my-theme' ),
    init.prompt( 'text_domain', 'wp-my-theme' ),
    
    init.prompt( 'namespace', 'UsabilityDynamics\\WP_Theme' ),
    init.prompt( 'bootstrap_class', 'Bootstrap' )
  ];

  init.process( options, prompts, processCallback );

  function processCallback( err, props ) {
  
    var _package = deepExtend( require( './root/package.json' ), props );
    var _composer = deepExtend( require( './root/composer.json' ), {} );

    // Copy Files.
    init.copyAndProcess( init.filesToCopy( _package ), _package );

    // Write Package to Disk.
    init.writePackageJSON( 'package.json', _package );
    
    done();

  }
  
};


