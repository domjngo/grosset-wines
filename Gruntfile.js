module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                sourcemap: false
            },
            dist: {
                files: {
                    'css/gw-styles.css': 'sass/gw-sass.scss'
                }
            }
        },
        cssmin: {
            options: {
                sourceMap: true
            },
            target: {
                files: {
                    'css/gw-styles.min.css': ['css/gw-styles.css']
                }
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['js/gw.js'],
                dest: 'js/compiled/gw.js'
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'js/compiled/gw.min.js': ['js/compiled/gw.js']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task(s).
    grunt.registerTask('default', ['sass', 'cssmin', 'concat', 'uglify']);

};