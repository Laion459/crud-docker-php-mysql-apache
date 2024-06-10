<?php

// Include necessary files for CPF and email validation
require_once __DIR__ . '/validate/ValidateCPF.php';
require_once __DIR__ . '/validate/ValidateEmail.php';

// Use the validation namespaces for easy access to their methods
use Validation\ValidateCPF;
use Validation\ValidateEmail;

// Function to validate CPF (Brazilian individual taxpayer registry identification)
function isValidCPF($cpf)
{
    // Use the ValidateCPF class's isValidCPF method to check if the CPF is valid
    return ValidateCPF::isValidCPF($cpf);
}

// Function to validate email address
function isValidEmail($email)
{
    // Use the ValidateEmail class's isValidEmail method to check if the email is valid
    return ValidateEmail::isValidEmail($email);
}
