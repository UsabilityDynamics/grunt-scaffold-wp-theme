/*
 * Node.js Scaffolding Template
 *
 *
 * @version 1.0.0
 */

// Basic template description.
exports.description = 'Create Wordpress Theme.';

// Template-specific notes to be displayed before question prompts.
exports.notes = '';

// Template-specific notes to be displayed after question prompts.
exports.after = '';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template.
exports.template = function(grunt, init, done) {

  init.process( {type: 'module'}, [

    init.prompt( 'name' ),
    init.prompt( 'short_name' ),
    init.prompt( 'description', 'Wordpress Theme' ),
    init.prompt( 'version', '0.1.0' ),
    init.prompt( 'license', 'GPL-2.0' ),
    init.prompt( 'license_url', 'http://www.gnu.org/licenses/gpl-2.0.html' ),
    init.prompt( 'author_name', 'Usability Dynamics' ),
    init.prompt( 'author_email', 'info@UsabilityDynamics.com' ),
    init.prompt( 'author_url', 'http://UsabilityDynamics.com' ),
    init.prompt( 'homepage', 'http://UsabilityDynamics.com' ),
    init.prompt( 'copyright', '(c) 2013 Usability Dynamics, Inc.' ),
    init.prompt( 'node_version', '>=0.10.21' )

  ], function( err, props ) {

    props.keywords = [ 'wordpress', 'theme', 'wp-property', 'responsive' ];

    props.dependencies = {};

    props.devDependencies = {
      "grunt": "~0.4.1",
      "grunt-contrib-symlink": "~0.2.0",
      "grunt-contrib-requirejs": "*",
      "grunt-contrib-yuidoc": "*",
      "grunt-contrib-clean": "~0.5.0",
      "grunt-contrib-jshint": "~0.6.4",
      "grunt-contrib-uglify": "~0.2.4",
      "grunt-contrib-watch": "~0.5.3",
      "grunt-contrib-less": "~0.7.0",
      "grunt-wp-version": "~0.1.0",
      "grunt-markdown": "~0.4.0",
      "grunt-requirejs": "*",
      "grunt-phpdocumentor": "~0.1.0",
      "grunt-spritefiles": "0.0.2",
      "grunt-component-build": "~0.4.1",
      "grunt-component": "~0.1.7",
      "grunt-contrib-concat": "~0.3.0",
      "grunt-shell": "~0.5.0"
    };

    props.repo = {
      type: 'git',
      url: 'git@github.com:UsabilityDynamics/' + props.short_name
    };

    props.homepage = 'http://github.com/UsabilityDynamics/' + props.short_name;

    props.bugs = 'http://github.com/UsabilityDynamics/' + props.short_name + '/issues';

    props.copyright = "Copyright (c) 2013 Usability Dynamics, Inc.";

    var _files = init.filesToCopy( props );
    
    console.log( _files );

    init.copyAndProcess( _files , props );

    init.writePackageJSON( 'package.json', props );

    done();

  });

};
