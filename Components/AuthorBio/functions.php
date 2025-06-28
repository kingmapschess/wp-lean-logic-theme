<?php
namespace LeanLogic\Components\AuthorBio;

add_filter('LeanLogic/context?component=AuthorBio', function ($author) {
    $author_id = $author['ID'] ?? null;

    return [
        'name' => $author['name'] ?? '',
        'description' => get_the_author_meta('description', $author_id),
        'avatar' => get_avatar_url($author_id),
    ];
});
