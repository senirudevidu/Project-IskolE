#!/bin/bash

# Docker management script for projectIskole
PROJECT_NAME="projectiskole-web"
CONTAINER_NAME="php_dev_env"
PORT="8080"
PROJECT_DIR="/home/snake/UCSC/UCSC/Year 2/Project/projectIskole"

case "$1" in
    build)
        echo "Building Docker image..."
        docker build -t $PROJECT_NAME .
        ;;
    up)
        echo "Starting container..."
        # Stop and remove existing container if it exists
        docker stop $CONTAINER_NAME 2>/dev/null || true
        docker rm $CONTAINER_NAME 2>/dev/null || true
        
        # Run new container
        docker run -d \
            --name $CONTAINER_NAME \
            -p $PORT:80 \
            -v "$PROJECT_DIR":/var/www/html \
            -e CLOUD_DB_HOST=mysql-iskole.alwaysdata.net \
            -e CLOUD_DB_USER=iskole_admin \
            -e CLOUD_DB_PASS="iskole+123" \
            -e CLOUD_DB_NAME=iskole_db \
            --restart unless-stopped \
            $PROJECT_NAME
        
        echo "Container started successfully!"
        echo "Access your application at: http://localhost:$PORT"
        ;;
    down)
        echo "Stopping container..."
        docker stop $CONTAINER_NAME
        docker rm $CONTAINER_NAME
        echo "Container stopped and removed."
        ;;
    logs)
        docker logs -f $CONTAINER_NAME
        ;;
    status)
        docker ps -f name=$CONTAINER_NAME
        ;;
    rebuild)
        echo "Rebuilding and restarting..."
        $0 build
        $0 up
        ;;
    *)
        echo "Usage: $0 {build|up|down|logs|status|rebuild}"
        echo ""
        echo "Commands:"
        echo "  build     - Build the Docker image"
        echo "  up        - Start the container"
        echo "  down      - Stop and remove the container"
        echo "  logs      - View container logs"
        echo "  status    - Show container status"
        echo "  rebuild   - Rebuild image and restart container"
        exit 1
        ;;
esac
