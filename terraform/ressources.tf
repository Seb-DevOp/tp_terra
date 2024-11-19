resource "aws_instance" "laravel_instance" {
  ami           = "ami-0864890e218d4dd30"
  instance_type = "t2.micro"
  key_name      = "my-key-pair"  # Assurez-vous que votre clé SSH est présente dans AWS
  security_groups = ["sg-06a9de32b71ebd17d - awseb-e-y3gwgpj9t5-stack-AWSEBSecurityGroup-ojDaqxNIFPYL"] 
  tags = {
    Name = "seb_terra_ec2"
  }
}