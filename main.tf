provider "aws" {
  region = "eu-north-1"  # Remplacez par la région souhaitée
}

# --- Créer un bucket S3 ---
resource "aws_s3_bucket" "deploy_bucket" {
  bucket = "Seb_Bucket_Terra"
  acl    = "private"

  versioning {
    enabled = true
  }
}

# --- Créer une instance EC2 ---
resource "aws_instance" "laravel_instance" {
  ami           = "ami-0864890e218d4dd30"
  instance_type = "t2.micro"
  key_name      = "my-key-pair"  # Assurez-vous que votre clé SSH est présente dans AWS

  security_groups = ["web-sg"]  # Vous pouvez créer un groupe de sécurité approprié

  tags = {
    Name = "LaravelAppInstance"
  }
}

# --- Créer un rôle IAM pour AWS CodeBuild ---
resource "aws_iam_role" "codebuild_role" {
  name = "CodeBuildRole"

  assume_role_policy = jsonencode({
    Version = "2012-10-17",
    Statement = [
      {
        Action = "sts:AssumeRole"
        Effect = "Allow"
        Principal = {
          Service = "codebuild.amazonaws.com"
        }
      }
    ]
  })
}

# Attacher des politiques au rôle IAM de CodeBuild
resource "aws_iam_role_policy_attachment" "codebuild_policy_attachment" {
  role       = aws_iam_role.codebuild_role.name
  policy_arn = "arn:aws:iam::aws:policy/AWSCodeBuildAdminAccess"
}

# --- Créer un projet CodeBuild ---
resource "aws_codebuild_project" "laravel_build_project" {
  name          = "laravel-Seb-Terra"
  description   = "Build and deploy Laravel application"
  build_timeout = 60

  environment {
    compute_type = "BUILD_GENERAL1_SMALL"
    image        = "aws/codebuild/standard:5.0"  # Choisissez l'image qui supporte PHP et Composer
    type         = "LINUX_CONTAINER"

    environment_variable {
      name  = "COMPOSER_CACHE_DIR"
      value = "/tmp/composer-cache"
    }
  }

  service_role = aws_iam_role.codebuild_role.arn

  source {
    type            = "S3"
    location        = "my-source-bucket/my-repo.zip"  # Remplacez avec le chemin de votre code source
    buildspec       = "buildspec.yml"
    auth {
      type = "NO_AUTH"
    }
  }

  artifacts {
    type     = "S3"
    location = aws_s3_bucket.deploy_bucket.bucket
    name     = "build-artifacts.zip"
    packaging = "ZIP"
    path      = "build-output"
  }
}

# --- Créer un rôle IAM pour CodeDeploy ---
resource "aws_iam_role" "codedeploy_role" {
  name = "CodeDeployRole"

  assume_role_policy = jsonencode({
    Version = "2012-10-17",
    Statement = [
      {
        Action = "sts:AssumeRole"
        Effect = "Allow"
        Principal = {
          Service = "codedeploy.amazonaws.com"
        }
      }
    ]
  })
}

# Attacher des politiques au rôle IAM de CodeDeploy
resource "aws_iam_role_policy_attachment" "codedeploy_policy_attachment" {
  role       = aws_iam_role.codedeploy_role.name
  policy_arn = "arn:aws:iam::aws:policy/CodeDeployFullAccess"
}

# --- Créer une application CodeDeploy ---
resource "aws_codedeploy_app" "laravel_app" {
  name = "laravel-app"
}

# --- Créer un groupe de déploiement CodeDeploy ---
resource "aws_codedeploy_deployment_group" "laravel_deployment_group" {
  app_name              = aws_codedeploy_app.laravel_app.name
  deployment_group_name = "laravel-deployment-group"
  service_role          = aws_iam_role.codedeploy_role.arn
  deployment_style {
    deployment_type    = "IN_PLACE"
    deployment_option  = "WITHOUT_TRAFFIC_CONTROL"
  }

  ec2_tag_filter {
    key   = "Name"
    value = "LaravelAppInstance"
    type  = "KEY_AND_VALUE"
  }
}
