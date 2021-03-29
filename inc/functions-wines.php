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

    $first = '<div class="vineyards">';
    $last = '</div>';

    $html = $first . vineyard_html( $a['image'], $a['title'], $a['link'], $a['text'] ) . $last;

    return $html;
}

function vineyard_html( $img, $title, $link, $text ) {

    $html = '<div class="vineyard-item col-md-2">';
    $html .= '<a href="%s"><img src="%s" alt="%s" class="img-responsive"></a>';
    $html .= '<h3><a href="%s">%s</a></h3>';
    $html .= '<p><small>%s</small></p>';
    $html .= '</div>';

    return sprintf( $html, $link, $img, $title, $link, $title, $text );
}
