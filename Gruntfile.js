module.exports = function(grunt) {

    // 1. Вся настройка находится здесь
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            // 2. Настройка для объединения файлов находится тут
			dist: {
				src: [
					//'template/js/*.js', // Все js в папке template/js
					'template/js/scr1.js',  // Конкретный файл
					'template/js/scr2.js'
				],
				dest: 'template/js/production.js',
			}
        },
		
		uglify: {
			build: {
				src: 'template/js/production.js',
				dest: 'template/js/production.min.js'
			}
		},
		
		sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				files: {
					'template/css/style.css': 'template/scss/style.scss'
				}
			}
		},
		
		watch: {
			scripts: {
				files: ['template/js/scr1.js', 'template/js/scr2.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false,
				},
			},
			css: {
				files: ['template/scss/*.scss'],
				tasks: ['sass'],
				options: {
					spawn: false,
				}
			}
		}

    });

    // 3. Тут мы указываем Grunt, что хотим использовать этот плагин
    grunt.loadNpmTasks('grunt-contrib-concat');	
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Указываем, какие задачи выполняются, когда мы вводим «grunt» в терминале
    grunt.registerTask('default', ['concat', 'uglify', 'sass']);
	grunt.registerTask('dev', ['watch']);

};