/**
 * Build Theme
 *
 * @author {%= author_name %}
 * @version {%= version %}
 * @param grunt
 */
module.exports = function( grunt ) {

  // Require Utility Modules.
  var joinPath  = require( 'path' ).join;
  var findup    = require( 'findup-sync' );

  // Determine Paths.
  var _paths = {
    composer: findup( 'composer.json' ),
    phpcs: findup( 'vendor/bin/phpcs' ) || findup( 'phpcs', { cwd: '/usr/bin' } ),
    vendor: findup( 'vendor' ),
    jsTests: findup( 'test' ),
    staticFiles: findup( 'static' )
  };

  // Automatically Load Tasks.
  require( 'load-grunt-tasks' )( grunt, {
    pattern: 'grunt-*',
    config: './package.json',
    scope: 'devDependencies'
  });

  grunt.initConfig({
  
    // Load configuration about project
    pkg: grunt.file.readJSON( 'composer.json' ),
    
    uglify: {
      'production': {
        options: {
          mangle: false,
          beautify: false
        },
        files: {
          'scripts/app.js':     [ 'scripts/app.dev.js' ],
          'scripts/require.js': [ 'vendor/usabilitydynamics/lib-utility/scripts/require.js' ]
        }
      }
    },
    
    requirejs: {
      fooxbox: {
        options: {
          name: 'foobox',
          paths: {
            "foobox": "scripts/src/foobox.dev"
          },
          include: [ 'foobox' ],
          out: 'scripts/utility/foobox.js',
          skipModuleInsertion: true,
          wrap: {
            start: "define( function(require, exports, module) {",
            end: "});"
          }
        }
      }
    },
    
    // Documentation
    yuidoc: {
      compile: {
        name: '<%= pkg.name %>',
        description: '<%= pkg.description %>',
        version: '<%= pkg.version %>',
        url: '<%= pkg.homepage %>',
        logo: 'http://media.usabilitydynamics.com/logo.png',
        options: {
          paths: './',
          outdir: 'static/codex'
        }
      }
    },
    
    // Less Compilation
    less: {
      'app.css': {
        options: {
          yuicompress: true,
          relativeUrls: true
        },
        files: {
          'styles/app.css': [ 'styles/src/app.less' ]
        }
      },
      'app.dev.css': {
        options: {
          relativeUrls: true
        },
        files: {
          'styles/app.dev.css': [ 'styles/src/app.less' ]
        }
      },
      'editor-style.dev.css': {
        options: {
          yuicompress: false,
          relativeUrls: true
        },
        files: {
          'styles/editor-style.dev.css': [ 'styles/src/editor-style.less' ]
        }
      },
      'editor-style.css': {
        options: {
          yuicompress: true,
          relativeUrls: true
        },
        files: {
          'styles/editor-style.css': [ 'styles/src/editor-style.less' ]
        }
      }
    },
    
    // Color Schemas
    'color-default': {
      options: {
        yuicompress: true,
        relativeUrls: true
      },
      files: {
        'styles/default.css': [ 'styles/src/colors/default.less' ]
      }
    },

    // Watcher
    watch: {
      options: {
        interval: 1000,
        debounceDelay: 500
      },
      styles: {
        files: [
          'gruntfile.js', 'styles/src/*.*'
        ],
        tasks: [ 'less' ]
      },
      scripts: {
        files: [
          'gruntfile.js', 'scripts/src/*.js'
        ],
        tasks: [ 'uglify', 'requirejs' ]
      },
      docs: {
        files: [
          'styles/app.*.css', 'composer.json', 'readme.md'
        ],
        tasks: [ 'markdown' ]
      }
    },
    
    markdown: {
      all: {
        files: [
          {
            expand: true,
            src: 'readme.md',
            dest: 'static/',
            ext: '.html'
          }
        ],
        options: {
          markdownOptions: {
            gfm: true,
            codeLines: {
              before: '<span>',
              after: '</span>'
            }
          }
        }
      }
    }

  });
  
  // Build Assets
  grunt.registerTask( 'default', [ 'yuidoc', 'uglify', 'markdown', 'less', 'requirejs' ] );

  // Install environment
  grunt.registerTask( 'install', [ 'yuidoc', 'uglify', 'markdown', 'less', 'requirejs' ] );

  // Update Environment
  grunt.registerTask( 'update', [ 'yuidoc', 'uglify', 'markdown', 'less', 'requirejs' ] );

  // Prepare distribution
  grunt.registerTask( 'dist', [ 'yuidoc', 'uglify', 'markdown', 'less', 'requirejs' ] );

  // Update Documentation
  grunt.registerTask( 'doc', [ 'yuidoc', 'markdown' ] );

};