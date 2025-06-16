pipeline {
    agent any

    environment {
        APP_URL = "http://integracioncontinuapoligran.brazilsouth.cloudapp.azure.com/"
        DB_HOST = "mi-postgres"
        DB_NAME = "gestor"
        DB_USER = "postgres"
        DB_PASSWORD = "ale2025"
    }

    stages {
        stage('Build and Start Application Services') {
            steps {
                script {
                    echo "Stopping existing Docker Compose services (excluding Jenkins itself)..."
                    sh "docker-compose stop web php-fpm db"
                    sh "docker-compose rm -f web php-fpm db" // Eliminar contenedores de la aplicación
                    echo "Building and starting web, php-fpm, and db services in detached mode..."
                    sh "docker-compose up -d --build web php-fpm db"
                }
            }
        }

        stage('Wait for Services to be Ready') {
            steps {
                script {
                    echo "Waiting for Nginx (web) and PHP-FPM to be ready..."
                    // Damos un pequeño respiro para que Docker Compose inicie los servicios.
                    sleep 15 // Aumentado ligeramente para dar tiempo a la DB y las apps.

                    // Esperar hasta que Nginx responda en el puerto 80
                    timeout(time: 5, unit: 'MINUTES') { // Aumenta el tiempo máximo de espera
                        waitUntil {
                            script {
                                try {
                                    def response = sh(script: "curl -s -o /dev/null -w '%{http_code}' ${APP_URL}", returnStdout: true).trim()
                                    echo "HTTP Status Code for ${APP_URL}: ${response}"
                                    return response == '200'
                                } catch (Exception e) {
                                    echo "Error checking application status: ${e.getMessage()}"
                                    return false
                                }
                            }
                        }
                    }
                    echo "Application services are ready!"
                }
            }
        }

        stage('Run Desktop Tests (Basic Functional)') {
            steps {
                script {
                    echo "Running basic functional tests on ${APP_URL}..."

                    // Prueba 1: Verificar que la página principal devuelve un código 200 OK
                    echo "Testing main page access..."
                    def mainPageStatus = sh(script: "curl -s -o /dev/null -w '%{http_code}' ${APP_URL}", returnStdout: true).trim()
                    if (mainPageStatus != '200') {
                        error "Main page did not return 200 OK. Status: ${mainPageStatus}"
                    } else {
                        echo "Main page returned 200 OK."
                    }

                    // Prueba 2: Verificar que el contenido de la página contiene un texto esperado
                    // ¡Importante! Reemplaza 'Gestor de Usuarios' con un texto real y único
                    // que esperes ver en la página principal de tu aplicación PHP.
                    echo "Testing content of the main page..."
                    def pageContent = sh(script: "curl -s ${APP_URL}", returnStdout: true)
                    if (!pageContent.contains("Gestor de Usuarios") && !pageContent.contains("Iniciar sesión")) {
                        error "Main page content does not contain expected text. Please check the page content or the expected text."
                    } else {
                        echo "Main page contains expected text."
                    }

                    // Prueba 3: Probar una ruta específica si tu aplicación la tiene, por ejemplo, una ruta de login
                    // Asume que tienes una ruta /login o /index.php que maneja el login
                    echo "Testing a specific application route (e.g., /index.php or /login)..."
                    def loginPageStatus = sh(script: "curl -s -o /dev/null -w '%{http_code}' ${APP_URL}/login.php", returnStdout: true).trim()
                    if (loginPageStatus != '200') {
                        error "Specific route (/index.php) did not return 200 OK. Status: ${loginPageStatus}"
                    } else {
                        echo "Specific route (/index.php) returned 200 OK."
                    }

                    echo "All basic desktop tests passed!"
                }
            }
        }
    }

    post {
        always {
            script {
                echo "Cleaning up application Docker Compose services..."
                // Nos aseguramos de apagar solo los servicios de la aplicación,
                // para no afectar al contenedor de Jenkins si se está ejecutando desde el mismo compose.
                sh "docker-compose down web php-fpm db --remove-orphans"
                echo "Cleanup complete."
            }
        }
        success {
            echo "Pipeline executed successfully! Application is stable."
        }
        failure {
            echo "Pipeline failed! Check the logs for errors and test failures."
        }
    }
}
