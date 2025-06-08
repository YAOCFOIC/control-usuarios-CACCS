pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = "proyecto_nomina_pipeline"
    }

    stages {
        stage('Clonar repositorio') {
            steps {
                checkout scm
            }
        }

        stage('Construir contenedores') {
            steps {
                sh 'docker-compose build --no-cache'
            }
        }

        stage('Verificar archivos en contenedor') {
            steps {
                sh 'docker-compose run --rm web ls -R /app'
            }
        }

        stage('Ejecutar pruebas') {
            steps {
                sh 'docker-compose run --rm web python -m unittest tests/test_app.py'
            }
        }

        stage('Desplegar') {
            when {
                expression { currentBuild.currentResult == 'SUCCESS' }
            }
            steps {
                echo 'Desplegando aplicación...'
                // Agrega aquí el script de despliegue, si aplica
            }
        }
    }

    post {
        always {
            echo "Limpieza de contenedores temporales si es necesario."
            sh 'docker-compose down --volumes --remove-orphans || true'
        }
    }
}
