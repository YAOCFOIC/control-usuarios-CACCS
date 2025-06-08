pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = "miproyecto-pipeline"
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

	stage('Limpiar Entorno Docker') {
            steps {
                sh 'docker-compose down --remove-orphans'
            }
        }

        stage('Verificar archivos en contenedor') {
            steps {
                sh 'docker-compose run --rm web ls -R /home/polipruebas/gestor'
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
