module.exports = function( grunt ) {

  var symlink   = require( 'fs' ).symlink;
  var process   = require( 'process' );

  grunt.registerTask( 'install', 'Create symbolic links.', function() {
  
    var done = this.async();
    symlinkPath = ( process.env.HOME || process.env.HOMEPATH || process.env.USERPROFILE ) + '/.grunt-init/scaffold-wp-theme';
    
    symlink( require( 'path' ).dirname( __dirname ), symlinkPath, 'dir', function( error ) { 

      if( error && error.code === 'EEXIST' ) { return done(); }
      
      console.log( 'linked', error ? error.message : 'successfully' );
      done();      
    });      
  
  });

}