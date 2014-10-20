## Build Theme
##
##

NAME = {%= name %}

# Default Install Action
default:
	npm install
  
# Build project
# - Removes composer.lock, vendor
# - Runs composer install --no-dev
# - Removes extra files.
build:
	echo Building $(NAME).
	make default
  grunt install

# Creates Release with Build Distribution
# Example: 
# make TAG=1.0.0 release
release:
	@echo Releasing $(NAME).
  make default
  sh build.sh $(TAG)