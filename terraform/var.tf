variable "aws_access_key_id" {
  description = "AWS Access Key ID"
  type        = string
  sensitive   = true  # Pour éviter que les valeurs des clés ne soient affichées dans les logs ou la sortie
}

variable "aws_secret_access_key" {
  description = "AWS Secret Access Key"
  type        = string
  sensitive   = true  # Pour éviter que les valeurs des clés ne soient affichées dans les logs ou la sortie
}
