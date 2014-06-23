/**
 * Library Build.
 *
 * @author peshkov@UD
 * @version 1.1.2
 * @param grunt
 */
module.exports = function build( grunt ) {

  grunt.initConfig({
    
    // Read Composer File.
    config: grunt.file.readJSON( 'package.json' ).config,
    
    // Non-configuration related meta
    meta: {
      ci: process.env.CI || process.env.CIRCLECI ? true : false,
      environment: process.env.NODE_ENV || 'production'
    }

  });
  
  // Require Utility Modules.
  var joinPath  = require( 'path' ).join;
  var findup    = require( 'findup-sync' );

  // Determine Paths.
  var _paths = {
    staticFiles: findup( 'static' )
  };

  // Automatically Load Tasks.
  require( 'load-grunt-tasks' )( grunt, {
    pattern: 'grunt-*',
    config: './package.json',
    scope: 'devDependencies'
  });
  
  // Register Internal Tasks.
  grunt.loadTasks( 'tasks' );
  
};