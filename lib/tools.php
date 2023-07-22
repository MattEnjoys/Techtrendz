<?php

/**
 * Convertit une chaîne de texte en un tableau de lignes en utilisant la séquence de saut de ligne PHP_EOL.
 *
 * @param string $string La chaîne de texte à convertir en tableau.
 * @return array Le tableau de lignes résultant.
 */
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
}


/**
 * Convertit une chaîne de texte en un slug convivial pour les URL.
 * Un slug est une version simplifiée du texte qui peut être utilisée dans une URL.
 *
 * @param string $text Le texte à slugifier.
 * @param string $divider Le séparateur à utiliser entre les mots du slug.
 * @return string Le slug résultant.
 */
function slugify($text, string $divider = '-')
{
    // Remplace les caractères non alphabétiques ou non numériques par le séparateur
    $text = preg_replace('~[^\pL\d.]+~u', $divider, $text);

    // Translitère les caractères spéciaux en caractères ASCII
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Supprime les caractères indésirables
    $text = preg_replace('~[^-\w.]+~', '', $text);

    // Supprime les séparateurs en début et fin de chaîne
    $text = trim($text, $divider);

    // Remplace les séparateurs multiples par un seul séparateur
    $text = preg_replace('~-+~', $divider, $text);

    // Met le slug en minuscules
    $text = strtolower($text);

    // Si le slug est vide, retourne 'n-a'
    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}