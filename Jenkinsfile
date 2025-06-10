pipeline {
    agent any

    environment {
        SONARQUBE = 'SonarQube' // Nombre que configuraste en "Manage Jenkins > SonarQube Servers"
        SCANNER = tool name: 'sonar-scanner', type: 'hudson.plugins.sonar.SonarRunnerInstallation'
    }

    stages {
        stage('Limpiar Entorno Docker') {
            steps {
                script {
                    echo 'Deteniendo y eliminando contenedores Docker anteriores para asegurar un entorno limpio...'
                    sh 'docker-compose down --remove-orphans'
                }
            }
        }

        stage('Clonar Repositorio') {
            steps {
                echo 'Clonando el repositorio Git...'
                checkout scm
            }
        }

        stage('Construir Contenedores') {
            steps {
                script {
                    echo 'Construyendo imágenes Docker...'
                    sh 'docker-compose build'
                }
            }
        }

        stage('Levantar Servicios') {
            steps {
                script {
                    dir('/var/jenkins_home/workspace/integracion_continua_pipeline') {
                        sh 'docker-compose down --rmi all --volumes --remove-orphans'
                    }
                    echo 'Levantando servicios Docker en segundo plano...'
                    sh 'docker-compose up -d'
                    echo 'Esperando a que la base de datos esté lista...'
                    sh 'for i in `seq 1 30`; do docker-compose exec db pg_isready -h localhost -p 5432 -U postgres && echo "Base de datos lista!" && break || sleep 2; done'
                }
            }
        }

        stage('Ejecutar pruebas') {
            steps {
                script {
                    echo 'Ejecutando pruebas en el contenedor web...'
                    sh 'docker-compose exec web python -m unittest discover /home/polipruebas/gestor/tests'
                }
            }
        }

        // 🚨 NUEVO: Etapa para ejecutar el análisis de SonarQube
        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv(SONARQUBE) {
                    sh "${SCANNER}/bin/sonar-scanner " +
                       "-Dsonar.projectKey=mi_php_proj " +
                       "-Dsonar.sources=." +
                       " -Dsonar.language=php" +
                       " -Dsonar.php.coverage.reportPaths=coverage.xml"
                }
            }
        }

        // ✅ Esperar a que SonarQube dé el resultado del Quality Gate
        stage('Quality Gate') {
            steps {
                timeout(time: 2, unit: 'MINUTES') {
                    waitForQualityGate abortPipeline: true
                }
            }
        }

        stage('Desplegar') {
            steps {
                echo 'Desplegando la aplicación...'
            }
        }
    }

    post {
        always {
            script {
                echo 'Limpiando contenedores al finalizar el pipeline...'
                sh 'docker-compose down --remove-orphans'
            }
        }
    }
}
