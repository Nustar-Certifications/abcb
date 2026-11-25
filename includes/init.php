<?php

declare(strict_types=1);

if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = 'AB-CB';
}

if (!isset($currentPage)) {
    $currentPage = '';
}

$accreditationPages = [
    'Benefits',
    'Howto_become_accredited',
    'Accredited_Body',
    'fee_structure',
    'Accreditation',
];

function site_url(string $page): string
{
    return htmlspecialchars($page . '.php', ENT_QUOTES, 'UTF-8');
}

function nav_li_class(string $page): string
{
    global $currentPage;

    return $currentPage === $page ? 'actives' : '';
}

function nav_home_class(): string
{
    global $currentPage;

    return $currentPage === 'index' ? 'actives' : 'active';
}

function nav_use_of_logo_class(): string
{
    global $currentPage;

    if ($currentPage === 'useof_logo') {
        return 'actives';
    }

    return 'last';
}

function in_accreditation_section(): bool
{
    global $currentPage, $accreditationPages;

    return in_array($currentPage, $accreditationPages, true);
}