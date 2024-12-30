terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 2.0"
    }
  }
}

# Docker provider configuration
provider "docker" {
  host = "tcp://172.16.51.49:2375"  # Docker host API to communicate with the remote Docker daemon
}

# Install Docker on the remote system if not installed
resource "null_resource" "install_docker" {
  connection {
    type        = "ssh"
    host        = "172.16.51.49"
    user        = "msis"
    private_key = file("/home/msis/.ssh/my-ssh-key")
  }

  provisioner "remote-exec" {
    inline = [
      # Check if Docker is installed, install it if not
      "which docker || echo '123#msis' | sudo -S apt-get update && echo 'password' | sudo -S apt-get install -y docker.io",

      # Start the Docker service
      "echo '123#msis' | sudo -S systemctl start docker",

      # Enable Docker service to start on boot
      "echo '123#msis' | sudo -S systemctl enable docker"
    ]
  }
}

# Build the Docker image using the Dockerfile from the current directory
resource "docker_image" "php_cafe_app_image" {
  name         = "premgowda07/php-cafe-app:latest"
  build {
    context = "./"  # Path to your local directory with Dockerfile
  }

  # Ensure Docker is installed before building the image
  depends_on = [null_resource.install_docker]
}

# Run the Docker container based on the built image
resource "docker_container" "php_cafe_app" {
  name  = "php-cafe-app-container"
  image = docker_image.php_cafe_app_image.latest

  ports {
    internal = 80
    external = 9092
  }

  # Ensure the image is built before starting the container
  depends_on = [docker_image.php_cafe_app_image]
}
