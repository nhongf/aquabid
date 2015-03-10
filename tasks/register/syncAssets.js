module.exports = function (grunt) {
	grunt.registerTask('syncAssets', [
		'jst:dev',
        'compass:dist',
		'sync:dev',
		'coffee:dev'
	]);
};
