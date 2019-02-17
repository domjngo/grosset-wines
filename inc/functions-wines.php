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

function vineyard_shortcode( $atts )
{
    $a = shortcode_atts(array(
        'image' => '',
        'title' => '',
        'link' => '',
        'text' => ''
    ), $atts);

    $first = '<div class="vineyard">';
    $last = '</div>';

    $html = $first . vineyard_html( $a['image'], $a['title'], $a['link'], $a['text'] ) . $last;

    return $html;
}

function vineyard_html( $img, $title, $link, $text ) {

    $html = '<div class="col-md-4">';
    $html .= '<img src="%s" alt="%s" class="img-responsive">';
    $html .= '</div>';
    $html .= '<div class="col-md-8">';
    $html .= '<h2>%s</h2>';
    $html .= '<p>%s';
    if ($link) {
        $html .= '<a href="%s" class="btn">Find out more</a>';
    }
    $html .= '</p>';
    $html .= '</div>';

    return sprintf( $html, $img, $title, $title, $text, $link );
}
