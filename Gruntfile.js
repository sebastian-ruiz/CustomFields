'use strict';

module.exports = function (grunt) {
    // load all grunt tasks
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.initConfig({
        watch: {
          scripts: {
            files: ["formwidgets/assets/dev/js/*.js", "formwidgets/assets/dev/*.js"],
            tasks: ["concat", "uglify"]
          },
          css: {
            // if any .less file changes in directory "public/css/" run the "less"-task.
            files: ["formwidgets/assets/dev/less/*.less", "formwidgets/assets/dev/*.less"],
            tasks: ["less"]
          }
        },
        // "less"-task configuration
        less: {
            // production config is also available
            development: {
                options: {
                    // Specifies directories to scan for @import directives when parsing.
                    // Default value is the directory of the source, which is probably what you want. Minify the CSS
                    paths: ["formwidgets/assets/dev/less/", "formwidgets/assets/dev/"],
                    plugins: [
                      new (require('less-plugin-clean-css'))({advanced: true})
                    ]
                },
                files: {
                    // compilation.css  :  source.less
                    "formwidgets/assets/dist/app.css": "formwidgets/assets/dev/main.less"
                }
            }
        },
        concat: {
          options: {
            separator: ';'
          },
          dist: {
            src: ['formwidgets/assets/dev/js/*.js', 'formwidgets/assets/dev/*.js'],
            dest: 'formwidgets/assets/dist/app.js'
          }
        },
        uglify: {
          options: {
            banner: '/*! formwidgets <%= grunt.template.today("dd-mm-yyyy") %> */\n'
          },
          dist: {
            files: {
              'formwidgets/assets/dist/app.min.js': ['<%= concat.dist.dest %>']
            }
          }
        }
        // jshint: {
        //   files: ['Gruntfile.js', 'assets/dev/js/*.js'],
        //   options: {
        //     // options here to override JSHint defaults
        //     globals: {
        //       jQuery: true,
        //       console: true,
        //       module: true,
        //       document: true
        //     }
        //   }
        // },
    });
    // the default task (running "grunt" in console) is "watch"
    grunt.registerTask('default', ['concat', 'uglify', 'less', 'watch']);
};
