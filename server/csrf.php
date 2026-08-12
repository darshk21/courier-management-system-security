<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrfInputField(): string
{
    $token = htmlspecialchars(generateCsrfToken(), ENT_QUOTES, 'UTF-8');

    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

function validateCsrfToken(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $submittedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';

    if (
        empty($submittedToken) ||
        empty($sessionToken) ||
        !hash_equals($sessionToken, $submittedToken)
    ) {
        http_response_code(403);
        exit('Invalid CSRF token.');
    }
}