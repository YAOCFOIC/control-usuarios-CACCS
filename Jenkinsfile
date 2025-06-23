pipeline {
    agent any

    environment {
        APP_URL = "http://localhost"
        DB_HOST = "mi-postgres"
        DB_NAME = "gestor"
        DB_USER = "postgres"
        DB_PASSWORD = "ale2025"
    }

    stages {
        stage('Build and Start Application Services') {
            steps {
                script {
                    echo "Stopping existing Docker Compose services"
                    sh "docker compose stop web php-fpm db"
                    echo "Servicios detenidos"
                    sh "docker compose rm -f web php-fpm db"
                    echo "Ejecuciones eliminadas"
                    sh "docker system prune -a -f --volumes" -y
                    echo "Limpieza general realizada"
                    sleep 10
                    echo "Construyendo contenedores desde el docker-compose.yml"
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

        stage('Ejecutando Pruebas de Escritorio (Funciones básicas)') {
            steps {
                script {
                    echo "Ejecutando funcionamiento básico en ${APP_URL}..."

                    // Prueba 1: Verificar que la página principal devuelve un código 200 OK
                    echo "Verificando página principal"
                    def mainPageStatus = sh(script: "curl -s -o /dev/null -w '%{http_code}' ${APP_URL}", returnStdout: true).trim()
                    if (mainPageStatus != '200') {
                        error "Pagina principal no retorna código 200 OK. Status: ${mainPageStatus}"
                    } else {
                        echo "Pagina principal retorna código 200 OK."
                    }

                    // Prueba 2: Verificar que el contenido de la página contiene un texto esperado
                    // ¡Importante! Reemplaza 'Gestor de Usuarios' con un texto real y único
                    // que esperes ver en la página principal de tu aplicación PHP.
                    echo "Probando contenido de la página..."
                    def pageContent = sh(script: "curl -s ${APP_URL}", returnStdout: true)
                    if (!pageContent.contains("Gestor de Usuarios") && !pageContent.contains("Iniciar sesión")) {
                        error "Se ha encontrado un error en la página probar su funcionamiento"
                    } else {
                        echo "Página funcionando correctamente."
                    }

                    // Prueba 3: Probar una ruta específica si tu aplicación la tiene, por ejemplo, una ruta de login
                    // Asume que tienes una ruta /login o /index.php que maneja el login
                    echo "Probando una ruta especifica de la página (e.g., /index.php or /login)..."
                    def loginPageStatus = sh(script: "curl -s -o /dev/null -w '%{http_code}' ${APP_URL}/menu.php", returnStdout: true).trim()
                    if (loginPageStatus != '200') {
                        error "Error al intentar conectar con (/index.php) no retorna código 200 OK. Status: ${loginPageStatus}"
                    } else {
                        echo "La ruta (/index.php) retorna código 200 OK."
                    }

                    echo "Las pruebas de escritorio fueron exitosas"
                }
            }
        }
    }

}
