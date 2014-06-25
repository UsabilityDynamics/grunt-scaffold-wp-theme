#!/usr/bin/env node

require( 'veneer-terminal' ).create( function scaffoldTerminal( error ) {

  var findUp = require( 'findup-sync' );
  var path = require('path');

  // Configure Terminal Settings.
  this.set({
    name: 'scaffold-wp-theme',
    version: this.get( 'package.version' ),
    description: this.get( 'package.description' ),
    path: path.dirname( findUp( 'package.json', { cwd: __dirname } ) )
  });  

  // Accepted Arguments.
  this.option( '-d, --directory <directory>', 'Path to target directory for scaffolding.', process.cwd() );
  this.option( '-p, --project <project>', 'Path or URL of project.yml file.' );
  this.option( '-a, --acceptance <acceptance>', 'Path or URL of acceptance.yml file.' );
  
  // Accepted Commands.
  this.command( 'create', 'Create new module in current directory from scaffold.' ).action( Create.bind( this ) );
  this.command( 'update',   'Updte existing module' ).action( Update.bind( this ) );
  this.command( 'validate', 'Validate an existing module' ).action( Validate.bind( this ) );

});

/**
 *
 *
 */
function Validate( options ) {  
  this.write( 'Validating ' + options.parent.path );
}

/**
 *
 *
 */
function Update( options ) {
  this.write( 'Updating ' + options.parent.path );
}

/**
 * Create Scaffold
 *
 * @todo Create options.parent.path if it does not exist.
 */
function Create( options ) {

  var spawn = require('child_process').spawn;
  var async = require( 'async' );
  var self  = this;

  async.auto({
    
    scaffold: [ function( done, report ) {
      self.write( 'Setting up structure.' );
      
      spawn( 'grunt-init', [ self.get( 'path' ), '--no-color' ], {
        end: process.env,
        cwd: options.parent.path,
        stdio: 'inherit',
        encoding: 'utf8'
      }).on( 'close', function( code, signal ) {
        self.log( 'Wordpress Theme scaffold complete.' );        
        done();
      });
            
    } ],

    // Should install all modules and then run "grunt install"
    npm: [ 'scaffold', function( done, report ) {
      self.log( 'Updating NPM...' );
      
      spawn( 'npm', [ 'install' ], {
        end: process.env,
        cwd: options.parent.directory,
        stdio: 'inherit',
        encoding: 'utf8'
      }).on( 'close', function() {
        self.log( 'Modules installed.' );
        done();
      });
        
    }],    
    
    // Should update composer, but wait for NPM to finish.
    composer: [ 'npm', 'scaffold', function( done, report ) {
      self.log( 'Installing Composer...' );
      
      spawn( 'php', [ self.get( 'composerPath' ), 'install', '--prefer-source' ], {
        end: process.env,
        cwd: options.parent.directory,
        stdio: 'inherit',
        encoding: 'utf8'
      }).on( 'close', function() {
        self.log( 'Composer installed.' );
        done();
      });
            
    }],
    
    // Should initialize repository, create a GitHub Wiki and add as a submodule to static/wiki
    github: [ 'npm', 'composer', function( done, report ) {
      // self.log( 'Setting up GitHub repository. (Not Implemented)' );
      
      done();
              
    }]
    
  });
  
}