<?php

declare(strict_types=1);

$root = dirname(__DIR__);

$htmlFiles = [
    'index.html',
    'aboutus.html',
    'Benefits.html',
    'Howto_become_accredited.html',
    'Accredited_Body.html',
    'fee_structure.html',
    'certifiedorganization.html',
    'useof_logo.html',
    'feedback.html',
    'contactus.html',
    'features.html',
    'Accreditation.html',
];

$searchScript = <<<'JS'


<script>
    $(document).ready(function () {
        $('#searchCertification').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'process/search.php',
                type: 'POST',
                dataType: 'json',
                data: $('#searchCertification').serializeArray(),
                beforeSend: function () {
                    $('input[type="text"], textarea').val('');
                },
                success: function (resp) {
                    $('.overlay').addClass('hidden');
                    if (resp.status) {
                        $('#certificationNoResult').addClass('hidden');
                        $('#certificationDetail').removeClass('hidden');
                        var data = resp.message;
                        $('.certificationNumber').html(data.certificationNumber);
                        $('.companyName').html(data.companyName);
                        $('.address').html(data.address);
                        $('.scheme').html(data.scheme);
                        $('.validTill').html(data.validTill);
                    } else {
                        $('#certificationNoResult').removeClass('hidden');
                        $('#certificationDetail').addClass('hidden');
                        $('#certificationNoResult').html(resp.message);
                    }
                }
            });
        });
    });
</script>
JS;

foreach ($htmlFiles as $htmlName) {
    $path = $root . DIRECTORY_SEPARATOR . $htmlName;
    if (!is_file($path)) {
        echo "Skip missing: {$htmlName}\n";
        continue;
    }

    $html = file_get_contents($path);
    if ($html === false) {
        echo "Read failed: {$htmlName}\n";
        continue;
    }

    $base = basename($htmlName, '.html');
    $currentPage = $base === 'index' ? 'index' : $base;

    if (!preg_match('/<footer>/i', $html, $footerMatch, PREG_OFFSET_CAPTURE)) {
        echo "No footer in: {$htmlName}\n";
        continue;
    }
    $footerPos = $footerMatch[0][1];

  if (!preg_match('/id=["\']top["\'][^>]*>\s*(.*?)\s*<footer>/is', $html, $m)) {
        echo "No body content in: {$htmlName}\n";
        continue;
    }

    $bodyInner = $m[1];
    if (!preg_match('/<\/div>\s*<\/div>\s*<\/div>\s*<\/div>\s*\n/is', $bodyInner, $navEnd, PREG_OFFSET_CAPTURE)) {
        echo "No nav end in: {$htmlName}\n";
        continue;
    }

    $contentStart = $navEnd[0][1] + strlen($navEnd[0][0]);
    $mainContent = substr($bodyInner, $contentStart);
    $mainContent = trim($mainContent);

    $mainContent = preg_replace('/\.html\b/i', '.php', $mainContent) ?? $mainContent;

    $title = ':: AB-CB ::';
    if (preg_match('/<title>\s*(.*?)\s*<\/title>/is', $html, $tm)) {
        $title = trim($tm[1]);
    }

    $extraScripts = '';
    if (stripos($html, 'searchCertification') !== false) {
        $extraScripts = $searchScript;
    }

    $php = "<?php\n";
    $php .= "\$pageTitle = " . var_export($title, true) . ";\n";
    $php .= "\$currentPage = " . var_export($currentPage, true) . ";\n";
    $php .= "\$extraScripts = " . var_export($extraScripts, true) . ";\n";
    $php .= "require __DIR__ . '/includes/head.php';\n";
    $php .= "require __DIR__ . '/includes/nav.php';\n";
    $php .= "?>\n";
    $php .= $mainContent . "\n";
    $php .= "<?php require __DIR__ . '/includes/footer.php'; require __DIR__ . '/includes/scripts.php'; ?>\n";

    $outName = $base . '.php';
    $outPath = $root . DIRECTORY_SEPARATOR . $outName;
    file_put_contents($outPath, $php);
    echo "Created: {$outName}\n";
}

echo "Done.\n";