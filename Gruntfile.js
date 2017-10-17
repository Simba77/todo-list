module.exports = function (grunt) {
    grunt.initConfig({
        // Проверка js на корректность
        jshint: {
            files: ['Gruntfile.js', 'src/**/*.js'],
            options: {
                globals: {
                    jQuery: true
                }
            }
        },
        // Отслеживание изменений
        watch: {
            files: [
                '<%= jshint.files %>',
                'public/assets/sass/*.scss',
                'public/assets/sass/paper/*.scss',
                'public/assets/css/*.css',
                '!public/assets/css/app.css',
                'public/assets/js/*.js',
                '!public/assets/js/app.js'
            ],
            tasks: ['sass:dev', 'cssmin', 'uglify', 'imagemin'] // При необходимости можно повесить все задачи по сборке сюда
        },
        // Компиляция sass
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    compass: false
                },
                files: [{
                    expand: true,
                    cwd: 'public/assets/sass',
                    src: ['*.sass', '*.scss'],
                    dest: 'public/assets/css',
                    ext: '.css'
                }]
            }
        },
        // Сборка, очистка, сжатие js в один файл. Windows 1251 не поддерживается, посему пока не используется.
        uglify: {
            options: {
                sourceMap: false,
                drop_console: true
            },
            build: {
                files: {
                    'public/assets/js/app.js': [
                        'public/assets/js/jquery-1.10.2.js',
                        'public/assets/js/bootstrap.min.js',
                        'public/assets/js/bootstrap-checkbox-radio.js',
                        'public/assets/js/chartist.min.js',
                        'public/assets/js/bootstrap-notify.js',
                        'public/assets/js/paper-dashboard.js',
                        'public/assets/js/demo.js'
                    ]
                }
            }
        },
        // Сборка и сжатие css в один файл
        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            build: {
                files: {
                    'public/assets/css/app.css': [
                        'public/assets/css/bootstrap.min.css',
                        'public/assets/css/animate.min.css',
                        'public/assets/css/paper-dashboard.css',
                        'public/assets/css/demo.css',
                        'public/assets/css/themify-icons.css'
                    ]
                }
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'public/assets/img/',
                    src: ['*.{png,jpg,gif}'],
                    dest: 'public/assets/img/'
                }]
            }
        }
    });

    // Загружаем задачи
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Сжатие изображений
    grunt.loadNpmTasks('grunt-contrib-imagemin');

    // Задача для разработки
    grunt.registerTask('dev', ['watch']);
    grunt.registerTask('upcss', ['cssmin']);

    // Задача для сборки
    grunt.registerTask('default', ['sass', 'uglify', 'cssmin']);
    grunt.registerTask('build', ['sass', 'uglify', 'cssmin']);

};