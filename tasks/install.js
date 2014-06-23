module.exports = function( grunt ) {

  var symlink   = require( 'fs' ).symlink;

  grunt.registerTask( 'install', 'Create symbolic links.', function() {
  
    var done = this.async();
  
    symlink( __dirname, '/Users/potanin/.grunt-init/wp-theme', 'dir', function( error ) {      
      console.log( 'linked', error ? error.message : 'successfully' );      
      done();      
    });      
  
  });

}