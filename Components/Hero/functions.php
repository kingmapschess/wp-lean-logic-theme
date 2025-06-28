<?php
namespace LeanLogic\Components\Hero;

add_filter('LeanLogic/context?component=Hero', function ($data) {
    $postId = get_the_ID();

    $data['heading'] = get_the_title($postId);
    $data['text'] = get_the_excerpt($postId);
    $data['image'] = get_the_post_thumbnail_url($postId, 'full');

    return $data;
});
