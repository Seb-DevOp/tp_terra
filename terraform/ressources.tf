resource "aws_instance" "laravel_instance" {
  ami           = "ami-0864890e218d4dd30"
  instance_type = "t2.micro"
  key_name = "658d3785-09f9-4fb7-bdca-c00956ed1044"
  security_groups = ["sg-06a9de32b71ebd17d"] 
  tags = {
    Name = "seb_terra_ec2"
  }
}