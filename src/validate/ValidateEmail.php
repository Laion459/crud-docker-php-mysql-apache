<?php

namespace Validation;

class ValidateEmail
{
    public static function isValidEmail($email)
    {
        // Remove leading and trailing whitespace from email
        $email = trim($email);

        // Check if email is valid using filter_var
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Check the total length of the email
        if (strlen($email) > 254) {
            return false;
        }

        // Check the length of the local part and the domain part
        list($localPart, $domain) = explode('@', $email, 2);
        if (strlen($localPart) > 64 || strlen($domain) > 255) {
            return false;
        }

        // Check if the email domain has MX (Mail Exchange) records
        if (!checkdnsrr($domain, 'MX')) {
            return false;
        }

        // Optional: Check if the email domain has A (Address) records
        if (!checkdnsrr($domain, 'A')) {
            return false;
        }

        // Additional regex check for extra validation
        $emailRegex = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
        if (!preg_match($emailRegex, $email)) {
            return false;
        }

        // Optional: Check against a list of known invalid domains
        $invalidDomains = ['example.com', 'test.com', 'invalid.com'];
        if (in_array($domain, $invalidDomains)) {
            return false;
        }

        return true;
    }
}
