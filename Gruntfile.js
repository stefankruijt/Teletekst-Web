module.exports = function(grunt) {
   grunt.initConfig({
      php: {
         dist: {
            options: {
               hostname: '127.0.0.1',
               port: 9000,
               base: '.',
               keepalive: true,
               open: false
            }
         }
      }
   });
   
   grunt.loadNpmTasks('grunt-php');

   grunt.registerTask('default', [
      'php:dist'
   ]);
}