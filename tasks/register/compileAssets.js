module.exports = function (grunt) {
	grunt.registerTask('compileAssets', [
		'clean:dev',
		'jst:dev',
		'less:dev',
//        'sass:dev',
        'compass:dist',
        'copy:dev',
		'coffee:dev'
	]);
};
