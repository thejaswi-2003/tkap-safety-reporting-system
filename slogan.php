<?php
$slogans = [
    "Safety first, always.",
    "Report it. Don't ignore it.",
    "A near-miss today prevents an accident tomorrow.",
    "Your safety is TKAP's priority.",
    "See something unsafe? Say something.",
    "Zero accidents is the only acceptable goal.",
    "Safety is everyone's responsibility.",
    "Think safe. Work safe. Home safe."
];
$random_slogan = $slogans[array_rand($slogans)];
?>

<div style="background-color:#0d6efd; color:white; text-align:center; padding:8px; font-size:14px; font-weight:500;">
    <?php echo $random_slogan; ?>
</div>