module.exports = function(grunt) {
   grunt.initConfig({
      php: {
         dist: {
            options: {
               hostname: '127.0.0.1',
               port: 9000,
               base: '.', // Project root 
               keepalive: true,
               open: false
            }
         }
      },
      browserSync: {
         dist: {
            bsFiles: {
               src: [
                  '*'
               ]
            },
            options: {
               proxy: '<%= php.dist.options.hostname %>:<%= php.dist.options.port %>',
               watchTask: true,
               notify: true,
               open: true,
               logLevel: 'silent',
               ghostMode: {
                  clicks: true,
                  scroll: true,
                  links: true,
                  forms: true
               }
            }
         }
      },
      watch: {
         livereload: {
            options: {
                  livereload: 35729 
               },
            files: ['*']
         }
      }
   });
   
   grunt.loadNpmTasks('grunt-contrib-watch');
   grunt.loadNpmTasks('grunt-php');

   grunt.registerTask('default', [
      'php:dist',    
      'watch',
   ]);
}