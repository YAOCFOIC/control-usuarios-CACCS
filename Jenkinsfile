pipeline {
    agent any // O un agente específico si tienes uno configurado

    stages {
        stage('Limpiar Entorno Docker') {
            steps {
                script {
                    echo 'Deteniendo y eliminando contenedores Docker anteriores para asegurar un entorno limpio...'
                    // Detiene y elimina todos los contenedores, redes y volúmenes anónimos
                    // asociados con tu docker-compose.yml.
                    // Esto es CRUCIAL para evitar el conflicto de nombres.
                    sh 'docker-compose down --remove-orphans'
                }
            }
        }

        stage('Clonar Repositorio') {
            steps {
                echo 'Clonando el repositorio Git...'
                // Esta etapa ya está funcionando correctamente
                checkout scm
            }
        }

        stage('Construir Contenedores') {
            steps {
                script {
                    echo 'Construyendo imágenes Docker...'
                    // Construye las imágenes. 'build' por sí solo ya usa la caché si no hay cambios
                    // sh 'docker-compose build --no-cache' // '--no-cache' es bueno para forzar, pero 'build' es suficiente si quieres usar la caché por defecto
                    sh 'docker-compose build'
                }
            }
        }

        stage('Levantar Servicios') {
            steps {
                script {
                    echo 'Levantando servicios Docker en segundo plano (db, web, etc.)...'
                    // Levanta todos los servicios definidos en docker-compose.yml en segundo plano.
                    // Esto hará que 'db' se cree y se inicie correctamente.
                    sh 'docker-compose up -d'

                    // Opcional pero ALTAMENTE RECOMENDADO: Esperar a que la base de datos esté lista
                    // Esto evita que tus pruebas fallen si la DB no ha terminado de iniciar.
                    echo 'Esperando a que la base de datos esté lista...'
                    sh 'for i in `seq 1 30`; do docker-compose exec db pg_isready -h localhost -p 5432 -U postgres && echo "Base de datos lista!" && break || sleep 2; done'
                    // Nota: 'postgres' es el usuario por defecto en muchas imágenes de Postgres.
                    // Asegúrate de que el usuario, host y puerto de la DB coincidan con tu docker-compose.yml.
                }
            }
        }

        stage('Ejecutar pruebas') {
            steps {
                script {
                    echo 'Ejecutando pruebas en el contenedor web...'
                    // Ahora que los servicios están levantados con 'docker-compose up -d',
                    // usa 'docker-compose exec' para ejecutar comandos DENTRO de los contenedores que YA están corriendo.
                    // Esto es la clave para evitar el conflicto de nombres de contenedor.
                    // Asegúrate de que la ruta de tus pruebas sea correcta dentro del contenedor 'web'.
                    // Por ejemplo, si tus pruebas están en el directorio 'tests' de tu aplicación web,
                    // y tu aplicación está en /var/www/html, la ruta correcta sería /var/www/html/tests
                    sh 'docker-compose exec web python -m unittest discover /var/www/html/tests' // O la ruta correcta de tus pruebas
                }
            }
        }

        // Si tienes una etapa de verificación de archivos o similar, iría aquí después de 'Levantar Servicios'
        // stage('Verificar archivos en contenedor') {
        //     steps {
        //         script {
        //             echo 'Verificando archivos en el contenedor web...'
        //             sh 'docker-compose exec web ls -R /var/www/html/gestor' // O la ruta correcta de tus archivos
        //         }
        //     }
        // }

        stage('Desplegar') {
            steps {
                echo 'Desplegando la aplicación...'
                // Tus comandos de despliegue irían aquí
            }
        }
    }

    // El bloque 'post' se ejecuta siempre al finalizar el pipeline,
    // ya sea que haya tenido éxito o haya fallado.
    post {
        always {
            script {
                echo 'Limpiando contenedores al finalizar el pipeline...'
                // Asegura que los contenedores se detengan y eliminen,
                // dejando el sistema limpio para la próxima ejecución.
                sh 'docker-compose down --remove-orphans'
            }
        }
    }
}
