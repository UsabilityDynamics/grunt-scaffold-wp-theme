module.exports = function( grunt ) {
  
  // Register NPM Tasks.
  grunt.registerTask( 'default', 'Status check and basic tests.', function() {

    // grunt.task.run( 'mochaTest' );
    
    if( grunt.config.get( 'meta.ci' ) ) {
      // grunt.task.run( 'test:quality' );
    }
    
  });
  
}