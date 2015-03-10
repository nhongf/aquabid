/**
 * Clean files and folders.
 *
 * ---------------------------------------------------------------
 *
 * This grunt task is configured to clean out the contents in the .tmp/public of your
 * sails project.
 *
 * For usage docs see:
 * 		https://github.com/gruntjs/grunt-contrib-clean
 */
module.exports = function(grunt) {

	grunt.config.set('compass', {
        dist: {
            options: { config: 'assets/styles/config.rb' }
        }
    });

	grunt.loadNpmTasks('grunt-contrib-compass');
};
