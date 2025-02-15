module.exports = (grunt) => {

  const sass = require('node-sass');

  grunt.initConfig({
    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      build: {
        options: {
          outputStyle: 'expanded'
        },
        files: {
          'style.css': 'sass/main.scss'
        }
      }
    },
    postcss: {
      autoprefix: {
        options: {
          processors: [
            require('autoprefixer')()
          ],
          map: {
            inline: false
          }
        },
        files: {
          'style.css': 'style.css',
          'backend/css/style.css': 'backend/css/style.css'
        }
      }
    },
    browserify: {
      options: {
        browserifyOptions: {
          extensions: ['.js']
        },
        transform: [
          [
            'babelify',
            {
              presets: ['@babel/env', '@babel/preset-react'],
              compact: true
            }
          ]
        ]
      },
      build: {
        files: {
          'backend/js/app.bundle.min.js': 'backend/js/source/app.js'
        }
      }
    },
    watch: {
      sass: {
        files: ['sass/**', 'backend/sass/**'],
        tasks: ['styles']
      },
      js: {
        files: ['backend/js/**/*.js', '!backend/js/**/*.min.js', '!backend/js/**/*.bundle.js'],
        tasks: ['scripts']
      }
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-browserify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Register global tasks
  grunt.registerTask('default', ['styles', 'scripts', 'launch']);

  // Register custom tasks
  grunt.registerTask('styles', ['sass:build', 'postcss:autoprefix']);
  grunt.registerTask('scripts', ['browserify:build']);
  grunt.registerTask('launch', ['watch']);
};
