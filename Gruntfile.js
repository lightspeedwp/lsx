'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        '/js/*.js',
        '!/js/scripts.min.js'
      ]
    },
    sass: {
      dist: {
          options: {
              style: 'compressed'
          },
          files: {
             '/css/main.min.css': '/sass/app.scss'
          }
        }
    },
    uglify: {
      dist: {
        files: {
          '/js/scripts.min.js': [
            '/js/plugins/bootstrap/transition.js',
            '/js/plugins/bootstrap/alert.js',
            '/js/plugins/bootstrap/button.js',
            '/js/plugins/bootstrap/carousel.js',
            '/js/plugins/bootstrap/collapse.js',
            '/js/plugins/bootstrap/dropdown.js',
            '/js/plugins/bootstrap/modal.js',
            '/js/plugins/bootstrap/tooltip.js',
            '/js/plugins/bootstrap/popover.js',
            '/js/plugins/bootstrap/scrollspy.js',
            '/js/plugins/bootstrap/tab.js',
            '/js/plugins/bootstrap/affix.js',
            '/js/plugins/*.js',
            '/js/_*.js',
            '/js/vendor/jquery.fitvids.js',
            '/js/custom/general.js'
          ]
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: '/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/roots//js/scripts.min.js.map'
        }
      }
    },
    version: {
      options: {
        file: 'inc/scripts.php',
        css: '/css/main.min.css',
        cssHandle: 'lsx_main',
        js: '/js/scripts.min.js',
        jsHandle: 'lsx_scripts'
      }
    },
    watch: {
      sass: {
        files: [
          '/sass/*.scss',
          '/sass/bootstrap/*.scss'
        ],
        tasks: ['sass', 'version']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify', 'version']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          '/css/main.min.css',
          '/js/scripts.min.js',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        '/css/main.min.css',
        '/js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-wp-version');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
