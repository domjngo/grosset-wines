<?php
$dir = get_template_directory_uri();
$data = array (
    array (
        "title" => "Grosset Polish Hill Riesling",
        "excerpt" => "There are subtle yet distinct floral aromatics of violets and lavender, lemon and lime blossom perfumes that persist.",
        "image" => $dir."/img/wine-polish-hill.png",
        "url" => "https://www.grosset.com.au/polish-hill-riesling/",
        "position" => "left"
    ),
    array (
        "title" => "Grosset Springvale Riesling",
        "excerpt" => "A swirl of the glass will unleash the potent aromas of this very different vintage of Grosset Springvale Riesling.",
        "image" => $dir."/img/wine-springvale.png",
        "url" => "https://www.grosset.com.au/springvale-watervale-riesling/",
        "position" => "right"
    ),
    array (
        "title" => "Grosset Alea Riesling",
        "excerpt" => "This has powerful aromatics – enticing lemon, lime blossom, with dried herb notes and hints of shaley minerality.",
        "image" => $dir."/img/wine-alea.png",
        "url" => "https://www.grosset.com.au/alea-riesling/",
        "position" => "left"
    ),
    array (
        "title" => "Grosset Apiana",
        "excerpt" => "The influence of the dry winter on Grosset Apiana is most overt in its richness and concentration in the mid-palate.",
        "image" => $dir."/img/wine-apiana.png",
        "url" => "https://www.grosset.com.au/apiana/",
        "position" => "right"
    ),
    array (
        "title" => "Grosset Nereus",
        "excerpt" => "Here, cooler Clare Valley shiraz is complemented by the inclusion of nero d’avola.",
        "image" => $dir."/img/wine-nereus.png",
        "url" => "https://www.grosset.com.au/nereus/",
        "position" => "left"
    ),
    array (
        "title" => "Grosset Gaia",
        "excerpt" => "Grosset Gaia is produced from cabernet sauvignon and cabernet franc grown at the rocky, isolated, wind-swept two-hectare Grosset Gaia Vineyard.",
        "image" => $dir."/img/wine-gaia.png",
        "url" => "https://www.grosset.com.au/gaia/",
        "position" => "right"
    ),
    array (
        "title" => "Grosset Piccadilly Chardonnay",
        "excerpt" => "This is once again, from the ultra cool Piccadilly Valley in the Adelaide Hills.",
        "image" => $dir."/img/wine-piccadilly.png",
        "url" => "https://www.grosset.com.au/piccadilly-chardonnay/",
        "position" => "left"
    ),
    array (
        "title" => "Grosset Pinot Noir",
        "excerpt" => "For more than a quarter of a century, this Pinot Noir has been produced from fruit grown in the ultra-cool Piccadilly Valley.",
        "image" => $dir."/img/wine-pinot-noir.png",
        "url" => "https://www.grosset.com.au/pinot-noir/",
        "position" => "right"
    ),
    array (
        "title" => "Grosset45 Spirit",
        "excerpt" => "Jeffrey Grosset’s fascination with the ancient art of distillation has led to the creation of a unique spirit from riesling.",
        "image" => $dir."/img/wine-45.png",
        "url" => "https://www.grosset.com.au/grosset45-spirit/",
        "position" => "left"
    )
);

foreach ($data as $item) {
    if ( $item['position'] == 'left' ) {
        $class = 'bg-grey';
        $first_col_position = 'col-md-6';
        $second_col_position = 'col-md-6';
    } else {
        $class = 'bg-white';
        $first_col_position = 'col-md-6 col-md-push-6';
        $second_col_position = 'col-md-6 col-md-pull-6';
    } ?>
<section class="wine-section <?php echo $class ?>">
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="<?php echo $first_col_position ?>">
                    <div class="wine-hero" style="background-image: url(<?php echo $item['image'] ?>)"></div>
                </div>
                <div class="<?php echo $second_col_position ?>">
                    <h2><?php echo $item['title'] ?></h2>
                    <p><?php echo $item['excerpt'] ?></p>
                    <p><a href="<?php echo $item['url'] ?>" class="btn">Read more</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>


