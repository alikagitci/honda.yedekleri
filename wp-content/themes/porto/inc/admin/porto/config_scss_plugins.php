// Porto Config Scss Plugins File
// Created at <?php echo date("Y-m-d H:i:s") ?>

<?php
$b = porto_check_theme_options();
?>

//** Padding between columns. Gets divided in half for the left and right.
$grid-gutter-width:         <?php echo $b['grid-gutter-width'] ?>px !default;

// Large screen / wide desktop
$container-large-desktop: (<?php echo $b['container-width'] ?>px) !default;
$screen-lg: (<?php echo $b['container-width'] + 29 ?>px) !default;

// Border radius
<?php if ($b['border-radius']) : ?>
    $border-radius-base:  4px !default;
    $border-radius-large: 6px !default;
    $border-radius-small: 3px !default;
    $pager-border-radius: 15px !default;
    $badge-border-radius: 10px !default;
    $border-radius-normal: 5px;
    $border-radius-base  : 4px;
    $border-radius-thick:  7px;
    $border-radius-strong: 8px;
    $scroll-border-radius: 10px;
    $scroll-border-radius-large: 12px;
<?php else : ?>
    $border-radius-base:  0 !default;
    $border-radius-large: 0 !default;
    $border-radius-small: 0 !default;
    $pager-border-radius: 0 !default;
    $badge-border-radius: 0 !default;
    $border-radius-normal: 0;
    $border-radius-base:   0;
    $border-radius-thick:  0;
    $border-radius-strong: 0;
    $scroll-border-radius: 0;
    $scroll-border-radius-large: 0;
<?php endif; ?>

<?php if ($b['thumb-padding']) : ?>
    //** Padding around the thumbnail image
    $thumbnail-padding:      4px !default;
    //** Thumbnail border color
    $thumbnail-border:       #ddd !default;
    $thumbnail-border-width: 1px;
    $thumbnail-slide-width:  99.5%;
<?php else : ?>
    //** Padding around the thumbnail image
    $thumbnail-padding:      0 !default;
    //** Thumbnail border color
    $thumbnail-border:       transparent !default;
    $thumbnail-border-width: 0;
    $thumbnail-slide-width:  100%;
<?php endif; ?>

