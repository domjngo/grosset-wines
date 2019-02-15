<?php

function wine_shortcode( $atts )
{
    $a = shortcode_atts(array(
        'image' => '',
        'title' => '',
        'link' => '',
        'start' => false,
        'last' => false
    ), $atts);

    $first = '';
    $last = '';
    if ( $a['start'] ) {
        $first = '<div class="wines">';
    }
    if ( $a['last'] ) {
        $last = '</div>';
    }

    $html = $first . wine_html( $a['image'], $a['title'], $a['link'] ) . $last;

    return $html;
}

function wine_html( $img, $title, $link ) {

    $html = '<div class="wine-item text-center">';
    $html .= '<a href="%s">';
    $html .= '<img src="%s" alt="%s" class="img-responsive">';
    $html .= '<h4>%s</h4>';
    $html .= '</a>';
    $html .= '</div>';

    return sprintf( $html, $link, $img, $title, $title );
}
