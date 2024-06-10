<?php

namespace Validation;

class ValidateCPF
{
    /**
     * Checks if a given CPF (Brazilian individual taxpayer registry number) is valid.
     *
     * @param string $cpf The CPF to be validated.
     * @return bool True if the CPF is valid, false otherwise.
     */
    public static function isValidCPF($cpf)
    {
        // Removes non-numeric characters
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Checks if the CPF has 11 digits
        if (strlen($cpf) != 11) {
            return false;
        }

        // Checks if all digits are the same
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calculates the first check digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = ($remainder < 2) ? 0 : 11 - $remainder;

        // Checks the first check digit
        if ($cpf[9] != $digit1) {
            return false;
        }

        // Calculates the second check digit
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $remainder = $sum % 11;
        $digit2 = ($remainder < 2) ? 0 : 11 - $remainder;

        // Checks the second check digit
        if ($cpf[10] != $digit2) {
            return false;
        }

        // Valid CPF
        return true;
    }
}
