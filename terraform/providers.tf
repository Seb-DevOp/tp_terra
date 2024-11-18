provider "aws" {
  region          = "eu-north-1"  # Stockholm
  access_key      = var.aws_access_key_id 
  secret_access_key = var.aws_secret_access_key 
}
